<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreUpdateFormRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class BrandController extends Controller
{
    private $brand;
    protected $totalPage = 20;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Marcas de Aviões';

        $brands = $this->brand->paginate($this->totalPage);

        return view('panel.brands.index', compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadatrar novo Avião';

        return view('panel.brands.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();

        if ($this->brand::create($dataForm))
            return redirect()
                    ->route('brands.index')
                    ->with('sucess', 'Cadastro realizado com sucesso!');
        else
            return redirect()   
                    ->back()
                    ->with('error', 'Falha ao cadastrar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
        return redirect()->back();

        $title = "Detalhes da marca: {$brand->name}";

        return view('panel.brands.show', compact('title', 'brand'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();
        $title = "Editar Marca: {$brand->name}";

        return view('panel.brands.create-edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandStoreUpdateFormRequest $request, $id)
    {
        $brand = $this->brand->find($id); // procura o item pelo id
        if(!$brand) //verifica se existe o id
            return redirect()->back(); //volta de onde saiu
        
        $update = $brand->update($request->all()); //atualiza o item

        if($update) //confere 
        return redirect()
                    ->route('brands.index')
                    ->with('success', 'Atualizado com Sucesso!');
        else {
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao Atualizar!');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);
        if(!$brand)
            return redirect()->back();
        
        if($brand->delete())
            return redirect()
                ->route('brands.index')
                ->with('sucess','Deletado com sucesso!');
            else
                return redirect()
                    ->back()
                    ->with('error','Falha ao deletar!');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $brands = $this->brand->search($request->key_search, $this->totalPage);

        $title = "Brands, filtros para: {$request->key_search}";

        return view('panel.brands.index', compact('title','brands', 'dataForm'));
    }
}
