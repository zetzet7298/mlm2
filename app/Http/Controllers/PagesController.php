<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get view file location from menu config
        $view = theme()->getOption('page', 'view');
        // Check if the page view file exist
        if ($view == 'index'){
            $products = Product::active()->orderBy('created_at', 'desc')
            // ->orderBy('featured', 'desc')
            ->take(3)->get();
            $categories = Category::all();
            $hotProducts = Product::active()->orderBy('featured', 'desc')->inRandomOrder()->take(6)->get();
            // dd($hotProducts);
            return view('pages.index')->with([
                'categories'=> $categories,
                'products'=> $products,
                'hotProducts' => $hotProducts
            ]);
        }
        if (view()->exists('pages.'.$view)) {
            return view('pages.'.$view);
        }

        // Get the default inner page
        return view('inner');
    }

    /**
     * Temporary function to replace icon duotone
     */
    public function replaceIcons()
    {
        $fileContent = file_get_contents(public_path('icon_replacement.txt'));
        $lines       = explode("\n", $fileContent);

        $patterns     = [];
        $replacements = [];
        foreach ($lines as $line) {
            $el             = explode(' - ', $line);
            $patterns[]     = trim($el[0]);
            $replacements[] = trim($el[1]);
        }

        $files    = File::allFiles(resource_path());
        $filtered = array_filter($files, function ($str) {
            return strpos($str, ".php") !== false;
        });

        foreach ($filtered as $file) {
            $bladeFileContent = file_get_contents($file->getPathname());

            $bladeFileContent = str_replace($patterns, $replacements, $bladeFileContent);

            file_put_contents($file->getPathname(), $bladeFileContent);
        }
    }
}
