<?php

namespace App\Enum;

enum Abilities: string
{
    case Admin = '*';

    /**
     * Права на товары, свойства и разделы
     */
    case ViewProducts = 'products:view';
    case AddProducts = 'products:add';
    case EditProducts = 'products:edit';
    case DeleteProducts = 'products:delete';

    /**
     * Права на оплаты
     */
    case AddPayments = 'payments:add';
    case EditPayments = 'payments:edit';
    case DeletePayments = 'payments:delete';

    /**
     * Права на доставки
     */
    case AddDeliveries = 'deliveries:add';
    case EditDeliveries = 'deliveries:edit';
    case DeleteDeliveries = 'deliveries:delete';

    /**
     * Права на ВСЕХ пользователей, текущий пользователь может делать всё кроме удаления
     */
    case AddUsers = 'users:add';
    case EditUsers = 'users:edit';
    case DeleteUsers = 'users:delete';

    /**
     * Права на ВСЕ заказы, товары заказа, свойства заказа, оплаты, доставки
     * Пользователь может создавать и просматривать только свои заказы
     */
    case ViewOrders = 'orders:view';
    case EditOrders = 'orders:edit';
    case DeleteOrders = 'orders:delete';

    /**
     * Права на ВСЕ корзины, текущий пользователь может делать всё
     * Если корзина пуста - она должна удаляться автоматически
     */
    case ViewBaskets = 'baskets:view';
    case EditBaskets = 'baskets:edit';
    case DeleteBaskets = 'baskets:delete';

    /**
     * Права на роли
    */
    case ViewRoles = 'roles:view';
    case AddRoles = 'roles:add';
    case EditRoles = 'roles:edit';
    case DeleteRoles = 'roles:delete';
}
