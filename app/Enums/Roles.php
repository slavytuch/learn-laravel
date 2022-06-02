<?php

namespace App\Enums;

class Roles
{
    const Admin = Abilities::Admin;

    const ProductManager = [
        Abilities::ViewProducts,
        Abilities::AddProducts,
        Abilities::EditProducts,
        Abilities::DeleteProducts
    ];
}