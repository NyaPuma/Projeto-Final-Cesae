<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\Supplier;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class StockUiController extends Controller
{
    /**
     * Dashboard do módulo de stock.
     */
    public function dashboard(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.dashboard', ['user' => $user]);
    }

    /**
     * Listagem de peças.
     */
    public function parts(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.parts', [
            'user' => $user,
            'categories' => PartCategory::query()->active()->orderBy('name')->get(),
        ]);
    }

    /**
     * Formulário de criação de peça.
     */
    public function partCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.parts.create', [
            'user' => $user,
            'categories' => PartCategory::query()->active()->orderBy('name')->get(),
            'taxRates' => TaxRate::query()->active()->orderBy('percent')->get(),
        ]);
    }

    /**
     * Detalhe de uma peça.
     */
    public function partShow(Request $request, Part $part): View
    {
        $user = $request->user();

        return view('ui.stock.parts.show', [
            'user' => $user,
            'part' => $part->load(['category', 'taxRate', 'suppliers']),
        ]);
    }

    /**
     * Formulário de edição de peça.
     */
    public function partEdit(Request $request, Part $part): View
    {
        $user = $request->user();

        return view('ui.stock.parts.edit', [
            'user' => $user,
            'part' => $part->load(['category', 'taxRate', 'suppliers']),
            'categories' => PartCategory::query()->active()->orderBy('name')->get(),
            'taxRates' => TaxRate::query()->active()->orderBy('percent')->get(),
        ]);
    }

    /**
     * Listagem de fornecedores.
     */
    public function suppliers(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.suppliers', ['user' => $user]);
    }

    /**
     * Formulário de criação de fornecedor.
     */
    public function supplierCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.suppliers.create', ['user' => $user]);
    }

    /**
     * Formulário de edição de fornecedor.
     */
    public function supplierEdit(Request $request, Supplier $supplier): View
    {
        $user = $request->user();

        return view('ui.stock.suppliers.edit', [
            'user' => $user,
            'supplier' => $supplier,
        ]);
    }

    /**
     * Listagem de movimentos de stock.
     */
    public function movements(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.movements', [
            'user' => $user,
            'parts' => Part::query()->active()->orderBy('name')->get(),
        ]);
    }

    /**
     * Gestão de taxas de IVA (admin).
     */
    public function taxRates(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.tax-rates', [
            'user' => $user,
            'taxRates' => TaxRate::query()->orderBy('percent')->get(),
        ]);
    }

    /**
     * Gestão de categorias de peças (admin).
     */
    public function categories(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.categories', [
            'user' => $user,
            'categories' => PartCategory::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Planos de manutenção preventiva.
     */
    public function plans(Request $request): View
    {
        $user = $request->user();

        return view('ui.stock.plans', [
            'user' => $user,
            'equipments' => Equipment::query()->active()->orderBy('name')->get(),
            'parts' => Part::query()->active()->orderBy('name')->get(),
        ]);
    }
}
