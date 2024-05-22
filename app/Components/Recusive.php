<?php

namespace App\Components;

class Recusive
{
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function permissionRecursive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            $key_code = $value['key_code'] ?? '';
            $idSelect = $value['id'];
            $nameSelect = $value['name'];

            $key_codes = $key_code ? "($key_code)" : '';

            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $idSelect) {
                    $this->htmlSelect .= "<option selected value='" . $idSelect . "'>" . $text . $nameSelect . " " . $key_codes . " </option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $idSelect . "'>" . $text . $nameSelect . " " . $key_codes . " </option>";
                }
                $this->permissionRecursive($parentId, $idSelect, $text . '--');
            }
        }
        return $this->htmlSelect;
    }
}
