<?php

namespace App\Http\Controllers\Frontend;

/**
 * Class UserPagesController.
 */
class UserPagesController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function bryan()
    {
        return view('frontend.pages.bryan');
    }
    public function cornell()
    {
        return view('frontend.pages.cornell');
    }
public function kinless()
{
    return view('frontend.pages.kinless');
}
}

