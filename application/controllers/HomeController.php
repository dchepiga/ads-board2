<?php

class HomeController extends BaseController
{
    function indexAction()
    {
        $this->view('content/index');
    }

    function postListAction()
    {
        $this->view('content/postList');
    }

    function pricingAction()
    {
        $this->view('content/pricing');
    }

    function postDetailAction()
    {
        $this->view('content/postDetail');
    }

    function addPostAction()
    {
        $this->view('content/addPost');
    }

    function termsAction()
    {
        $this->view('content/terms');
    }

    function aboutAction()
    {
        $this->view('content/about');
    }

    // for image download example
    // will be moved to correct controller
    function imageDownloadAction()
    {
        ChromePhp::log($_FILES);
    }
}