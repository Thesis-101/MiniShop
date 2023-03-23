<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Item;

class ItemOperation extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('items/item_setup');
    }

    public function create_item()
    {
        $validated = $this->validate([
            'item_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Item name must not be empty.'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description must not be empty.',
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Quantity must not be empty.',
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price must not be empty.',
                ]
            ]
        ]);

        if(!$validated)
        {
             return view('items/item_setup', ['validation' => $this->validator]);
        }

        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'description' => $this->request->getPost('description'),
            'quantity' => $this->request->getPost('quantity'),
            'price' => $this->request->getPost('price'),
        ];

        $item = new Item();
        $query = $item->insert($data);

        if(!$query)
        {
            return redirect()->back()->with('fail', 'Failed to add item.');
        }
        else
        {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    {
        $item = new Item();
        $data['item'] = $item->find($id);
        return view('items/edit',$data);
    }

    public function update($id)
    {
        $validated = $this->validate([
            'item_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Item name must not be empty.'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description must not be empty.',
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Quantity must not be empty.',
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price must not be empty.',
                ]
            ]
        ]);

        if(!$validated)
        {
             return view('items/edit', ['validation' => $this->validator]);
        }

        $data = [
            'id' => $id,
            'item_name' => $this->request->getPost('item_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'quantity' => $this->request->getPost('quantity'),
        ];

        $item = new Item();
        $item->update($id, $data);

        return redirect()->to('/');
    }

    public function delete($id)
    {
        $item = new Item();
        $item->delete($id);
        return redirect()->to('/');
    }
}
