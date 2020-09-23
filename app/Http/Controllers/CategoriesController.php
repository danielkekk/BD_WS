<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::select("SELECT node.id, node.name
                                        FROM categories AS node,
                                        categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND parent.name = 'ELECTRONICS'
                                        ORDER BY node.lft;", []);

        $categoriesWithDepth = DB::select("SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.id, node.name
                                        ORDER BY node.lft;", []);

        return view('categories', ['categories' => $categories, 'categoriesWithDepth' => $categoriesWithDepth]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getLeafCategories()
    {
        $categories = DB::select("SELECT name
                                        FROM categories
                                        WHERE rgt = lft + 1;", []);

        return view('categories', ['categories' => $categories]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSinglePath($node)
    {
        $categories = DB::select("SELECT parent.name
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                AND node.name = :node
                                        ORDER BY parent.lft;", ['node' => $node]);

        return view('categories', ['categories' => $categories]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDepthOfNodes()
    {
        $categories = DB::select("SELECT node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.name
                                        ORDER BY node.lft;", []);

        return view('categories', ['categories' => $categories]);
    }

    /**
     * TODO
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDepthOfSubtree($node)
    {
        $categories = DB::select("SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                                        FROM categories AS node,
                                            categories AS parent,
                                            categories AS sub_parent,
                                            (
                                                SELECT node.name, (COUNT(parent.name) - 1) AS depth
                                                FROM categories AS node,
                                                categories AS parent
                                                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                AND node.name = :node
                                                GROUP BY node.name
                                                ORDER BY node.lft
                                            ) AS sub_tree 
                                            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                                                AND sub_parent.name = sub_tree.name
                                                GROUP BY node.name
                                        ORDER BY node.lft;", ['node' => $node]);

        return view('categories', ['categories' => $categories]);
    }

    /**
     * TODO
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubordinates($node)
    {
        $categories = DB::select("SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                                        FROM categories AS node,
                                                categories AS parent,
                                                categories AS sub_parent,
                                                (
                                                        SELECT node.name, (COUNT(parent.name) - 1) AS depth
                                                        FROM categories AS node,
                                                                categories AS parent
                                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                                AND node.name = :node
                                                        GROUP BY node.name
                                                        ORDER BY node.lft
                                                )AS sub_tree
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                                                AND sub_parent.name = sub_tree.name
                                        GROUP BY node.name
                                        HAVING depth <= 1
                                        ORDER BY node.lft;", ['node' => $node]);

        return view('categories', ['categories' => $categories]);
    }


    public function addNewNode($node,$newnode)
    {
        /*LOCK TABLE nested_category WRITE;

SELECT @myRight := rgt FROM nested_category
WHERE name = 'TELEVISIONS';

UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight;
UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight;

INSERT INTO nested_category(name, lft, rgt) VALUES('GAME CONSOLES', @myRight + 1, @myRight + 2);

UNLOCK TABLES;
        */

        //tranzakció
        //megkeressük ami mellé be akarjuk szúrni annak a rgtjét
        //updatelünk mindent
        //beszúrjuk a többit

        $rgt = (array)DB::selectOne("SELECT rgt
                                        FROM categories
                                        WHERE name = :node;", ['node' => $node]);

        $updated = DB::update("UPDATE categories SET rgt = rgt + 2 WHERE rgt > :myRight;", ['myRight' => $rgt['rgt']]);
        $updated1 = DB::update("UPDATE categories SET lft = lft + 2 WHERE lft > :myRight;", ['myRight' => $rgt['rgt']]);

        $inserted = DB::insert('INSERT INTO categories(name, lft, rgt) VALUES(:newnode, :myRightplusone, :myRightplustwo);',
            ['newnode' => trim($newnode),
            'myRightplusone' => ((int)$rgt['rgt']+1),
            'myRightplustwo' => ((int)$rgt['rgt']+2)]);

        return redirect()->route('categories');
    }

    public function addNewNodeASChildOfNode($node,$newnode)
    {
        /*LOCK TABLE nested_category WRITE;

SELECT @myLeft := lft FROM nested_category

WHERE name = '2 WAY RADIOS';

UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myLeft;
UPDATE nested_category SET lft = lft + 2 WHERE lft > @myLeft;

INSERT INTO nested_category(name, lft, rgt) VALUES('FRS', @myLeft + 1, @myLeft + 2);

UNLOCK TABLES;
        */

        //tranzakció
        //megkeressük ami mellé be akarjuk szúrni annak a rgtjét
        //updatelünk mindent
        //beszúrjuk a többit

        $lft = (array)DB::selectOne("SELECT lft
                                        FROM categories
                                        WHERE name = :node;", ['node' => $node]);

        $updated = DB::update("UPDATE categories SET rgt = rgt + 2 WHERE rgt > :myLeft;", ['myLeft' => $lft['lft']]);
        $updated1 = DB::update("UPDATE categories SET lft = lft + 2 WHERE lft > :myLeft;", ['myLeft' => $lft['lft']]);

        $inserted = DB::insert('INSERT INTO categories(name, lft, rgt) VALUES(:newnode, :myLeftplusone, :myLeftplustwo);',
            ['newnode' => trim($newnode),
                'myLeftplusone' => ((int)$lft['lft']+1),
                'myLeftplustwo' => ((int)$lft['lft']+2)]);

        return redirect()->route('categories');
    }

    public function deleteLeafNode($node)
    {
        /*LOCK TABLE nested_category WRITE;

SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
FROM nested_category
WHERE name = 'GAME CONSOLES';

DELETE FROM nested_category WHERE lft BETWEEN @myLeft AND @myRight;

UPDATE nested_category SET rgt = rgt - @myWidth WHERE rgt > @myRight;
UPDATE nested_category SET lft = lft - @myWidth WHERE lft > @myRight;

UNLOCK TABLES;
        */

        //tranzakció
        //megkeressük ami mellé be akarjuk szúrni annak a rgtjét
        //updatelünk mindent
        //beszúrjuk a többit

        $deleteProp = (array)DB::selectOne("SELECT lft, rgt, (rgt - lft + 1) as width
                                            FROM categories
                                            WHERE name = :node;", ['node' => $node]);

        $deleted = DB::delete('DELETE FROM categories WHERE lft BETWEEN :myLeft AND :myRight;',['myLeft' => $deleteProp['lft'],
            'myRight' => $deleteProp['rgt']]);

        $updated = DB::update("UPDATE categories SET rgt = rgt - :myWidth WHERE rgt > :myRight;", ['myWidth' => $deleteProp['width'],
            'myRight' => $deleteProp['rgt']]);
        $updated1 = DB::update("UPDATE categories SET lft = lft - :myWidth WHERE lft > :myRight;", ['myWidth' => $deleteProp['width'],
            'myRight' => $deleteProp['rgt']]);

        return redirect()->route('categories');
    }

    public function deleteParentNode($node)
    {
        /*LOCK TABLE nested_category WRITE;

SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
FROM nested_category
WHERE name = 'PORTABLE ELECTRONICS';

DELETE FROM nested_category WHERE lft = @myLeft;

UPDATE nested_category SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN @myLeft AND @myRight;
UPDATE nested_category SET rgt = rgt - 2 WHERE rgt > @myRight;
UPDATE nested_category SET lft = lft - 2 WHERE lft > @myRight;

UNLOCK TABLES;
        */

        //tranzakció
        //megkeressük ami mellé be akarjuk szúrni annak a rgtjét
        //updatelünk mindent
        //beszúrjuk a többit

        $deleteProp = (array)DB::selectOne("SELECT lft, rgt, (rgt - lft + 1) as width
                                            FROM categories
                                            WHERE name = :node;", ['node' => $node]);

        $deleted = DB::delete('DELETE FROM categories WHERE lft = :myLeft;',['myLeft' => $deleteProp['lft']]);

        $updated = DB::update("UPDATE categories SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN :myLeft AND :myRight;", ['myLeft' => $deleteProp['lft'],
            'myRight' => $deleteProp['rgt']]);
        $updated1 = DB::update("UPDATE categories SET rgt = rgt - 2 WHERE rgt > :myRight;", ['myRight' => $deleteProp['rgt']]);
        $updated2 = DB::update("UPDATE categories SET lft = lft - 2 WHERE lft > :myRight;", ['myRight' => $deleteProp['rgt']]);

        return redirect()->route('categories');
    }

    public function categoryTree()
    {
        //el kell dönteni h a parentnek vannak gyerekei v nincsenek
        //lekérjük a nodeokat a mélységükkel
        $categoriesWithDepth = DB::select("SELECT node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.name
                                        ORDER BY node.lft;", []);

        return view('editcategories', ['categories' => $categoriesWithDepth]);
    }

    public function createNewNode(Request $request)
    {
        $isLeaf = false;
        $leafcategories = DB::select("SELECT id, name
                                            FROM categories
                                            WHERE rgt = lft + 1;", []);

        foreach($leafcategories as $cat) {
            if((int)$cat->id == (int)$request['parentcategories']) {
                $isLeaf = true;
                break;
            }
        }

        if($isLeaf === true) {
            //ha levél akkor beteszük mintha nem lenne létező gyereke
            $lft = (array)DB::selectOne("SELECT lft
                                        FROM categories
                                        WHERE id = :node;", ['node' => (int)$request['parentcategories']]);

            $updated = DB::update("UPDATE categories SET rgt = rgt + 2 WHERE rgt > :myLeft;", ['myLeft' => $lft['lft']]);
            $updated1 = DB::update("UPDATE categories SET lft = lft + 2 WHERE lft > :myLeft;", ['myLeft' => $lft['lft']]);

            $inserted = DB::insert('INSERT INTO categories(name, lft, rgt) VALUES(:newnode, :myLeftplusone, :myLeftplustwo);',
                ['newnode' => trim($request['name']),
                    'myLeftplusone' => ((int)$lft['lft']+1),
                    'myLeftplustwo' => ((int)$lft['lft']+2)]);

        } else {
            //megnézni az összes mélységét
            $depthofcategories = DB::select("SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.name, node.id
                                        ORDER BY node.lft;", []);

            //kiekeressük a parent+1 mélységűt lft szerint sorba van rendezve,
            $parent = null;
            foreach($depthofcategories as $cat) {
                if((int)$cat->id == (int)$request['parentcategories']) {
                    $parent = $cat;
                    break;
                }
            }

            //a parentnél egyel nagyobb méylségű kell abból a legkisebb azonosítójút oda kell beszúrni elé
            $firstChildOfParent = null;
            foreach($depthofcategories as $cat) {
                if((int)$cat->depth == (int)$parent->depth+1) {
                    $firstChildOfParent = $cat;
                    break;
                }
            }

            $lft = (array)DB::selectOne("SELECT lft
                                        FROM categories
                                        WHERE id = :node;", ['node' => (int)$parent->id]);

            $updated = DB::update("UPDATE categories SET rgt = rgt + 2 WHERE rgt > :myLeft;", ['myLeft' => $lft['lft']]);
            $updated1 = DB::update("UPDATE categories SET lft = lft + 2 WHERE lft > :myLeft;", ['myLeft' => $lft['lft']]);

            $inserted = DB::insert('INSERT INTO categories(name, lft, rgt) VALUES(:newnode, :myLeftplusone, :myLeftplustwo);',
                ['newnode' => trim($request['name']),
                    'myLeftplusone' => ((int)$lft['lft']+1),
                    'myLeftplustwo' => ((int)$lft['lft']+2)]);

        }

        return redirect()->route('categories');

        //el kell dönteni h a parentnek vannak gyerekei v nincsenek
        //eszerint lefuttatni a megfelelő addnode algoritmust

        //lekérjük az összes leafnodeot ha benne van nincsenek gyerekei
    }

    public function removeNode($nodeid)
    {
        //megnézni h vannak-e gyerekei v nincsenek
        //ha vannak gyerekei csak parentes algoritmus
        //ha nincsenek a sima leaf nodeot törlő
        $deletedNodeId = (int)$nodeid;
        $isLeaf = false;
        $leafcategories = DB::select("SELECT id, name
                                            FROM categories
                                            WHERE rgt = lft + 1;", []);

        foreach($leafcategories as $cat) {
            if((int)$cat->id == (int)$deletedNodeId) {
                $isLeaf = true;
                break;
            }
        }

        if($isLeaf === true) {
            $deleteProp = (array)DB::selectOne("SELECT lft, rgt, (rgt - lft + 1) as width
                                            FROM categories
                                            WHERE id = :node;", ['node' => $deletedNodeId]);

            $deleted = DB::delete('DELETE FROM categories WHERE lft BETWEEN :myLeft AND :myRight;',['myLeft' => $deleteProp['lft'],
                'myRight' => $deleteProp['rgt']]);

            $updated = DB::update("UPDATE categories SET rgt = rgt - :myWidth WHERE rgt > :myRight;", ['myWidth' => $deleteProp['width'],
                'myRight' => $deleteProp['rgt']]);
            $updated1 = DB::update("UPDATE categories SET lft = lft - :myWidth WHERE lft > :myRight;", ['myWidth' => $deleteProp['width'],
                'myRight' => $deleteProp['rgt']]);
        } else {
            $deleteProp = (array)DB::selectOne("SELECT lft, rgt, (rgt - lft + 1) as width
                                            FROM categories
                                            WHERE id = :node;", ['node' => $deletedNodeId]);

            $deleted = DB::delete('DELETE FROM categories WHERE lft = :myLeft;',['myLeft' => $deleteProp['lft']]);

            $updated = DB::update("UPDATE categories SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN :myLeft AND :myRight;", ['myLeft' => $deleteProp['lft'],
                'myRight' => $deleteProp['rgt']]);
            $updated1 = DB::update("UPDATE categories SET rgt = rgt - 2 WHERE rgt > :myRight;", ['myRight' => $deleteProp['rgt']]);
            $updated2 = DB::update("UPDATE categories SET lft = lft - 2 WHERE lft > :myRight;", ['myRight' => $deleteProp['rgt']]);
        }

        return redirect()->route('categories');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsBrowser()
    {
        $categories = DB::select("SELECT node.id, node.name
                                        FROM categories AS node,
                                        categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND parent.name = 'ELECTRONICS'
                                        ORDER BY node.lft;", []);

        $categoriesWithDepth = DB::select("SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.id, node.name
                                        ORDER BY node.lft;", []);


        $sql = "SELECT av.id AS avid,av.categories_id,av.attributes_id,a.web_name,a.type_id,a.azon,av.value,av.min,av.max,av.step 
                FROM attributes_values AS av LEFT JOIN attributes AS a ON a.id=av.attributes_id WHERE av.categories_id IN (3) 
                ORDER BY av.attributes_id ASC;";
        $filters = DB::select(DB::raw($sql), []);

        $azon = '';
        $szurok = [];
        $arrindex = -1;
        foreach($filters as $a) {
            $filter = (array)$a;

            if($azon != $filter['azon']) {
                $azon = $filter['azon'];
                ++$arrindex;
                $szurok[] = [
                    'web_name' => $filter['web_name'],
                    'type' => $filter['type_id'],
                    'azon' => $filter['azon'],
                    'values' => [
                        ''.$filter['avid'] => $filter['value']
                    ],
                    'min' => $filter['min'],
                    'max' => $filter['max'],
                    'step' => $filter['step'],
                ];
            } else {
                $szurok[$arrindex]['values'][(string)$filter['avid']] = $filter['value'];
            }
        }

        return view('termekek', ['categories' => $categories, 'categoriesWithDepth' => $categoriesWithDepth,
            'filters' => $szurok]);
    }

    public function getTermekek($catid)
    {
        $categoriesWithDepth = DB::select("SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                                        FROM categories AS node,
                                                categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        GROUP BY node.id, node.name
                                        ORDER BY node.lft;", []);


        //lekérdezzük a catid alapján h levél-e v vannak-e gyerekei.
        $nodeId = (int)$catid;
        $isLeaf = false;
        $leafcategories = DB::select("SELECT id, name
                                            FROM categories
                                            WHERE rgt = lft + 1;", []);

        foreach($leafcategories as $cat) {
            if((int)$cat->id == (int)$nodeId) {
                $isLeaf = true;
                break;
            }
        }

        if($isLeaf) {
            //ha levél akkor kilistázzuk a catidhoz tartozó termékeket attribútumokat stb.
            $childs = [$catid];
            $sql = "SELECT pr.id AS productid,pr.category_id,pr.name,pr.qty,pav.id,pav.products_id,pav.attributes_id,pav.attributes_values_id,pav.value AS pavvalue, attr.id,attr.web_name AS attrname, av.id,av.value AS avvalue 
                    FROM products AS pr LEFT JOIN products_attributes_values AS pav ON pav.products_id=pr.id 
                    LEFT JOIN attributes AS attr ON attr.id=pav.attributes_id 
                    LEFT JOIN attributes_values AS av ON av.id=pav.attributes_values_id 
                    WHERE category_id IN (".implode(',', $childs).") ORDER BY pr.id ASC;";
            $termekek = DB::select(DB::raw($sql), []);
        } else {
            //ha nem levél akkor a catid és összes gyerek catidhoz tartozó termékek attribútumok kilistázása...
            $childCategories = DB::select("SELECT node.id, node.name, node.azon
                                        FROM categories AS node,
                                        categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND parent.id = :catid
                                        ORDER BY node.lft;", ['catid' => $catid]);

            $childs = [];
            foreach($childCategories as $child) {
                $childs[] = (int)$child->id;
            }

            $sql = "SELECT pr.id AS productid,pr.category_id,pr.name,pr.qty,pav.id,pav.products_id,pav.attributes_id,pav.attributes_values_id,pav.value AS pavvalue, attr.id,attr.web_name AS attrname, av.id,av.value AS avvalue 
                    FROM products AS pr LEFT JOIN products_attributes_values AS pav ON pav.products_id=pr.id 
                    LEFT JOIN attributes AS attr ON attr.id=pav.attributes_id 
                    LEFT JOIN attributes_values AS av ON av.id=pav.attributes_values_id 
                    WHERE category_id IN (".implode(',', $childs).") ORDER BY pr.id ASC";
            $termekek = DB::select(DB::raw($sql), []);
            //print_r($termekek); exit;
            //echo implode(",", $childs); exit;
        }


        /*TODO
        SELECT pr.id AS productid,attr.web_name,pr.category_id,pr.name,pr.qty,pav.id,pav.products_id,pav.attributes_id,
        pav.attributes_values_id,pav.value AS pavvalue, attr.id,attr.web_name AS attrname, attr.azon AS attrazon, av.id,
        av.value AS avvalue FROM products AS pr LEFT JOIN products_attributes_values AS pav ON pav.products_id=pr.id
        LEFT JOIN attributes AS attr ON attr.id=pav.attributes_id LEFT JOIN attributes_values AS av ON av.id=pav.attributes_values_id
        WHERE category_id IN (3) AND ((av.value='Botanic') AND (pav.value>1 AND pav.value<78)) ORDER BY pr.id ASC
        */

        /*Meg kell nézni hány darab sor volt ha anyi mint amennyi szűrőfeltétel azokat az idjú productokat kilistázzuk
         *
          SELECT pr.id, COUNT(pr.id) AS countpr, pr.name FROM products AS pr
          LEFT JOIN products_attributes_values AS pav ON pav.products_id=pr.id
          LEFT JOIN attributes AS attr ON attr.id=pav.attributes_id LEFT JOIN attributes_values AS av ON av.id=pav.attributes_values_id
          WHERE category_id IN (3) AND ((pav.attributes_values_id=1) OR (pav.value>1 AND pav.value<49))
          GROUP BY pr.id HAVING COUNT(pr.id)=2 ORDER BY pr.id ASC
         *
         *
         */

        //TODO lekérdezni a kategóriához tartozó szűrőket, attribútumokat
        //TODO lekérdezni minden termékhez a hozzá tartozó szűrőit és azok értékeit
        /*Adott kategóriához az összes szűrő
         * SELECT av.categories_id,av.attributes_id,a.web_name,a.azon,av.value,av.min,av.max,av.step
        FROM attributes_values AS av LEFT JOIN attributes AS a ON a.id=av.attributes_id WHERE av.categories_id IN (3)
         */
        $sql = "SELECT av.id AS avid,av.categories_id,av.attributes_id,a.web_name,a.type_id,a.azon,av.value,av.min,av.max,av.step 
                FROM attributes_values AS av LEFT JOIN attributes AS a ON a.id=av.attributes_id WHERE av.categories_id IN (3) 
                ORDER BY av.attributes_id ASC;";
        $filters = DB::select(DB::raw($sql), []);

        $azon = '';
        $szurok = [];
        $arrindex = -1;
        foreach($filters as $a) {
            $filter = (array)$a;

            if($azon != $filter['azon']) {
                $azon = $filter['azon'];
                ++$arrindex;
                $szurok[] = [
                    'web_name' => $filter['web_name'],
                    'type' => $filter['type_id'],
                    'azon' => $filter['azon'],
                    'values' => [
                        ''.$filter['avid'] => $filter['value']
                    ],
                    'min' => $filter['min'],
                    'max' => $filter['max'],
                    'step' => $filter['step'],
                ];
            } else {
                $szurok[$arrindex]['values'][(string)$filter['avid']] = $filter['value'];
            }
        }

        //echo implode(",", $childs); exit;
        return view('termekek', ['categoriesWithDepth' => $categoriesWithDepth,
            'termekek' => $termekek,
            'filters' => $szurok]);
    }

    public function attributesBrowser()
    {
        $attr = DB::select("SELECT *
                                        FROM attributes;", []);

        return view('attributes', ['attributes' => $attr]);
    }

    public function addAttribute(Request $request)
    {
        $isExistAttr = (array)DB::selectOne("SELECT id
                                        FROM attributes
                                        WHERE azon = :azon;", ['azon' => Str::lower($request['azon'])]);

        if(empty($isExistAttr)) {
            $inserted = DB::insert('INSERT INTO attributes(web_name, name, azon, type_id) VALUES(:web_name, :name, :azon, :type_id);',
                ['web_name' => trim($request['name']),
                    'name' => trim($request['azon']),
                    'azon' => trim($request['azon']),
                    'type_id' => 'select']);
        }

        return redirect()->route('attributumok');
    }

    public function removeAttribute($id)
    {
        $deleted = DB::delete('DELETE FROM attributes WHERE id = :id;',['id' => trim($id)]);

        //itt még törölni kell más táblákból is dolgokat
        //TODO kaszkádolt törlés???

        return redirect()->route('attributumok');
    }

    public function attributesValuesBrowser($attrid)
    {
        $attributesvalues = DB::select("SELECT * FROM attributes_values WHERE attributes_id=:aid;", ['aid' => $attrid]);

        $categories = DB::select("SELECT * FROM categories;", []);

        return view('attributesvalues', ['attributesvalues' => $attributesvalues,
            'categories' => $categories,
            'attribute_id' => $attrid]);
    }

    public function addAttributeValue(Request $request)
    {
        $inserted = DB::insert('INSERT INTO attributes_values(categories_id, attributes_id, value) VALUES(:categories_id, :attributes_id, :value);',
            ['categories_id' => trim($request['attrcategory']),
                'attributes_id' => trim($request['attrid']),
                'value' => trim($request['value'])]);

        return redirect()->route('addattributesvalues', ['attrid' => trim($request['attrid'])]);
    }

    public function removeAttributeValue($attrid, $id)
    {
        $deleted = DB::delete('DELETE FROM attributes_values WHERE id = :id;',['id' => trim($id)]);

        //itt még törölni kell más táblákból is dolgokat
        //TODO kaszkádolt törlés???

        return redirect()->route('addattributesvalues', ['attrid' => trim($attrid)]);
    }

    public function categoriesAttributesBrowser($categoryid)
    {
        $categoriesattributes = DB::select("SELECT * FROM attributes 
                                                WHERE id NOT IN (
                                                SELECT attributes_id 
                                                FROM categories_attributes WHERE categories_id=:cid);", ['cid' => $categoryid]);

        $attributes = DB::select("SELECT attr.id, cattr.categories_id, cattr.attributes_id, attr.web_name FROM categories_attributes AS cattr LEFT JOIN attributes AS attr ON cattr.attributes_id = attr.id 
                                        WHERE categories_id=:cid", ['cid' => $categoryid]);

        return view('categoriesattributes', ['categoriesattributes' => $categoriesattributes,
            'attributes' => $attributes,
            'category_id' => $categoryid]);
    }

    public function addCategoriesAttribute(Request $request)
    {
        $inserted = DB::insert('INSERT INTO categories_attributes(categories_id, attributes_id) VALUES(:categories_id, :attributes_id);',
            ['categories_id' => trim($request['categoryid']),
                'attributes_id' => trim($request['attributes'])]);

        return redirect()->route('categoriesattributes', ['categoryid' => trim($request['categoryid'])]);
    }

    public function removeCategoriesAttribute($categoriesid, $attributesid)
    {
        $deleted = DB::delete('DELETE FROM categories_attributes 
                                      WHERE categories_id = :catid AND attributes_id = :attrid;'
                                     ,['catid' => trim($categoriesid),
                                        'attrid' => trim($attributesid)]);

        //itt még törölni kell más táblákból is dolgokat
        //TODO kaszkádolt törlés???

        return redirect()->route('categoriesattributes', ['categoryid' => trim($categoriesid)]);
    }

}
