<?php

namespace App\Http\Controllers\ProdutosController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Produtos\Categorias_produto as Categoria;
use Session;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categ = Categoria::all();
        $produtos = Produto::orderBy('categoria','asc')->orderBy('name','asc')->paginate(20);
        return view('adm_pages.produtos.index')->withProdutos($produtos)->withCategorias($categ);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categ = Categoria::all();
        return view('adm_pages.produtos.cadastro')->withCategorias($categ);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data

        $this->validate($request,array(

            'name'        => 'required|min:2|max:255',
            'marca'       => 'max:255',
            'categoria'   => 'required|numeric',
            'descricao'   => 'nullable|min:2|max:1000',
            'valor_venda' => 'nullable|numeric'
        ));

        // store data

        $produto = new Produto;

        $produto->name = $request->name;
        $produto->marca = $request->marca;
        $produto->categoria = $request->categoria;
        $produto->descricao = $request->descricao;
        $produto->valor_venda = $request->valor_venda;

        $produto->save();

        // create a flash success msg
        Session::flash('success','Produto cadastrado com sucesso.');

        // redirect to produtos
        return redirect()->route('produto.show',$produto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {   
        $categ = Categoria::all();
        $prod = Produto::find($produto->id);        
        return view('adm_pages.produtos.show')->withProduto($prod)->withCategorias($categ);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {   
        $categ = Categoria::all();
        $prod = Produto::find($produto->id);

        return view('adm_pages.produtos.edit')->withProduto($prod)->withCategorias($categ);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
       // validate data

        $this->validate($request,array(

            'name'        => 'required|min:2|max:255',
            'marca'       => 'max:255',
            'categoria'   => 'required|numeric',
            'descricao'   => 'nullable|min:2|max:1000',
            'valor_venda' => 'nullable|numeric'
        ));

        // store data

        $Produto2 = Produto::find($produto->id);

        $Produto2->name = $request->input('name');
        $Produto2->marca = $request->input('marca');
        $Produto2->categoria = $request->input('categoria');
        $Produto2->descricao = $request->input('descricao');
        $Produto2->valor_venda = $request->input('valor_venda');

        $Produto2->update();

        // create a flash success msg
        Session::flash('success','Produto cadastrado com sucesso.');

        // redirect to produtos
        return redirect()->route('produto.show',$Produto2->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //Finds the item to be deleted
        $produtoParaDeletar = Produto::find($produto->id);
        //Add the item's name to a variable for show in success message
        $nomeProduto = $produtoParaDeletar->name;
        //Delete item from data base
        $produtoParaDeletar->delete();

        Session::flash('success',"O produto $nomeProduto Cod:$produto->id foi deletado com sucesso.");

        return redirect()->route('produto.index');
    }
}
