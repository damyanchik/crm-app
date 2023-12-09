<?php

declare(strict_types=1);

namespace App\Enum;

class RolesPermissionsEnum
{
    const STORE_OFFER = 'storeOffer';
    const UPDATE_OFFER = 'updateOffer';
    const DESTROY_OFFER = 'destroyOffer';
    const MAKE_ORDER = 'makeOrder';
    const READY_ORDER = 'readyOrder';
    const CLOSE_ORDER = 'closeOrder';
    const REJECT_ORDER = 'rejectOrder';
    const STORE_PRODUCT = 'storeProduct';
    const UPDATE_PRODUCT = 'updateProduct';
    const DESTROY_PRODUCT = 'destroyProduct';
    const STORE_BRAND = 'storeBrand';
    const UPDATE_BRAND = 'updateBrand';
    const DESTROY_BRAND = 'destroyBrand';
    const STORE_PRODUCT_CATEGORY = 'storeProductCategory';
    const UPDATE_PRODUCT_CATEGORY = 'updateProductCategory';
    const DESTROY_PRODUCT_CATEGORY = 'destroyProductCategory';
    const STORE_CLIENT = 'storeClient';
    const UPDATE_CLIENT = 'updateClient';
    const DESTROY_CLIENT = 'destroyClient';
    const BLOCK_USER = 'blockUser';
    const UPDATE_USER = 'updateUser';
    const CHANGE_PASSWORD_USER = 'changePasswordUser';
    const DELETE_AVATAR_USER = 'deleteAvatarUser';
    const STORE_CALENDAR = 'storeCalendar';
    const DESTROY_CALENDAR = 'destroyCalendar';
    const VIEW_ADMIN = 'viewAdmin';
    const COMPANY_DETAILS_ADMIN = 'companyDetailsAdmin';
    const EMPLOYEE_ADMIN = 'employeeAdmin';
    const ROLES_PERMISSIONS_ADMIN = 'rolesPermissionsAdmin';
    const SETTINGS_ADMIN = 'settingsAdmin';

    public static function getPolishName(string $name): string
    {
        $map = [
            self::STORE_OFFER => 'Dodawanie oferty',
            self::UPDATE_OFFER => 'Aktualizacja oferty',
            self::DESTROY_OFFER => 'Usuwanie oferty',
            self::MAKE_ORDER => 'Tworzenie zamówienia',
            self::READY_ORDER => 'Zamówienie gotowe',
            self::CLOSE_ORDER => 'Zamknięcie zamówienia',
            self::REJECT_ORDER => 'Odrzucenie zamówienia',
            self::STORE_PRODUCT => 'Dodawanie produktu',
            self::UPDATE_PRODUCT => 'Aktualizacja produktu',
            self::DESTROY_PRODUCT => 'Usuwanie produktu',
            self::STORE_BRAND => 'Dodawanie marki',
            self::UPDATE_BRAND => 'Aktualizacja marki',
            self::DESTROY_BRAND => 'Usuwanie marki',
            self::STORE_PRODUCT_CATEGORY => 'Dodawanie kategorii produktu',
            self::UPDATE_PRODUCT_CATEGORY => 'Aktualizacja kategorii produktu',
            self::DESTROY_PRODUCT_CATEGORY => 'Usuwanie kategorii produktu',
            self::STORE_CLIENT => 'Dodawanie klienta',
            self::UPDATE_CLIENT => 'Aktualizacja klienta',
            self::DESTROY_CLIENT => 'Usuwanie klienta',
            self::BLOCK_USER => 'Blokowanie użytkownika',
            self::UPDATE_USER => 'Aktualizacja użytkownika',
            self::CHANGE_PASSWORD_USER => 'Zmiana hasła użytkownika',
            self::DELETE_AVATAR_USER => 'Usuwanie avatara użytkownika',
            self::STORE_CALENDAR => 'Dodawanie kalendarza',
            self::DESTROY_CALENDAR => 'Usuwanie kalendarza',
            self::VIEW_ADMIN => 'Widok panelu administratora',
            self::COMPANY_DETAILS_ADMIN => 'Ustawienia firmy w panelu',
            self::EMPLOYEE_ADMIN => 'Ustawienia pracownika w panelu',
            self::ROLES_PERMISSIONS_ADMIN => 'Role i uprawnienia w panelu',
            self::SETTINGS_ADMIN => 'Ustawienia strony w panelu',
        ];

        return $map[$name] ?? $name;
    }
}
