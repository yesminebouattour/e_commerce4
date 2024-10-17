<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     *Cette méthode récupère toutes les catégories de la base de données en utilisant Categorie::all() 
     */
    public function index()
    {
   try {
    $categories=categorie::all();
    return response()->json($categories);
    } catch (\Exception $e){
        return response()->json("probleme de recipuration");
    }
}

    /**
     * Cette méthode crée une nouvelle catégorie.
     */
    public function store(Request $request)
    {
   try {
        $categorie=new categorie([
            "nomcategorie"=>$request -> input("nomcategorie"),
            "imagecategorie"=>$request -> input("imagecategorie")
        ]);
        $categorie ->save();
        return response()->json($categorie);
    }catch (\Exception $e){
        return response()->json("Insertion impossible");
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $categorie=categorie::finOrFail($id);
            return response()->json($categorie);

        }catch(\Exception $e){
            response()->json("recuperation de categorie impossible{$e->getmessage()}");
        }
    }

    /**
     *Cette méthode met à jour une catégorie existante.
     */
    public function update(Request $request, $id)

    {
        try{
              $categorie=Categorie::FindOrFail($id);
              $categorie->update($request->all());
              return response()->json($categorie);

        }catch(\Exception $e){
            return response ()->json($e->getMessage());
        }
        
    }

    /**
     * Cette méthode supprime une catégorie existante en fonction de son ID..
     */
    public function destroy( $id)
    {
         try{
            $categorie=categorie::finOrFail($id);
            $categorie->delete();
            return response()->json("suppresion impossible");

        }catch(\Exception $e){
            response()->json("recuperation de categorie impossible{$e->getmessage()}");
        }
    }
}

