<?php

namespace Controller;

use Helper\Config;
use Infrastructure\Request\Request;
use Model\User;

class InvoiceController
{

    public function all()
    {
        echo 'Index(all) Method';
    }

    public function save(Request $request)
    {
        $request->all();
        echo 'Save Method';
    }

    public function delete()
    {
        echo 'Delete Method';
    }

    public function update()
    {
        echo 'Update Method';
    }
}