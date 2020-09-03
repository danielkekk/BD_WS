<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $categories = DB::select("SELECT node.name
                                        FROM categories AS node,
                                        categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND parent.name = 'ELECTRONICS'
                                        ORDER BY node.lft;", []);

        return view('categories', ['categories' => $categories]);
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
}
