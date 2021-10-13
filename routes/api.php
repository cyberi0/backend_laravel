<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ComplexController;
use App\Http\Controllers\ComplexControlController;
use App\Http\Controllers\ComplexPlanController;
use App\Http\Controllers\ComplexProviderController;
use App\Http\Controllers\AgreementsController;
use App\Http\Controllers\AgreementPaymentsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UserBalanceController;
use App\Http\Controllers\UserBalanceTransactionsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ProviderAccountsController;
use App\Http\Controllers\ProviderCategoryController;
use App\Http\Controllers\ComplexProviderTaxDataController;
use App\Http\Controllers\CommonAreaController;
use App\Http\Controllers\CommonAreaReservationsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsViewsController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\ComplexAdministrationTypesController;
use App\Http\Controllers\ComplexAdministrationRolesController;
use App\Http\Controllers\ComplexAdministrationsController;
use App\Http\Controllers\ComplexBalanceAccountsController;
use App\Http\Controllers\ComplexBalanceConfigController;
use App\Http\Controllers\ComplexBalanceWithdrawalsController;
use App\Http\Controllers\ComplexBalancePaymentsController;
use App\Http\Controllers\ComplexFeeTypesController;
use App\Http\Controllers\ComplexFeesController;
use App\Http\Controllers\ComplexTypesController;
use App\Http\Controllers\ComplexUsesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\FailedJobsController;
use App\Http\Controllers\MethodsController;
use App\Http\Controllers\OxxoOrdersController;
use App\Http\Controllers\OxxoOrderPaymentsController;
use App\Http\Controllers\PaymentProvidersController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertyTypesController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TagTypesController;
use App\Http\Controllers\TagStatusesController;
use App\Http\Controllers\UserCardsController;
use App\Http\Controllers\UserMercadopagoController;
use App\Http\Controllers\UserMercadopagoCardsController;
use App\Http\Controllers\UserPasswordResetsController;
use App\Http\Controllers\UserPushTokensController;
use App\Http\Controllers\UserSessionsController;
use App\Http\Controllers\UserTypesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VehicleTypesController;
use App\Http\Controllers\VehiclesController;

/*
|--------------------------------------------------------------------------
| Guest Access Control
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\PropertyGuestsController;
use App\Http\Controllers\GuestAccessControlConcededTypesController;
use App\Http\Controllers\GuestAccessControlDocumentTypesController;
use App\Http\Controllers\GuestAccessControlDocumentsController;
use App\Http\Controllers\GuestAccessControlController;
use App\Http\Controllers\LostObjectsControlController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/plan/create', [PlanController::class, 'create']);
Route::get('/plan/getAll', [PlanController::class, 'getAll']);
Route::get('/plan/getByID/{id}', [PlanController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/plan/update', [PlanController::class, 'update']);
Route::post('/plan/delete/{id}', [PlanController::class, 'delete']);

Route::post('/complex/create', [ComplexController::class, 'create']);
Route::get('/complex/getAll', [ComplexController::class, 'getAll']);
Route::get('/complex/getByID/{id}', [ComplexController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex/update', [ComplexController::class, 'update']);
Route::post('/complex/delete/{id}', [ComplexController::class, 'delete']);

Route::post('/complex-control/create', [ComplexControlController::class, 'create']);
Route::get('/complex-control/getAll', [ComplexControlController::class, 'getAll']);
Route::get('/complex-control/getByID/{id}', [ComplexControlController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-control/update', [ComplexControlController::class, 'update']);
Route::post('/complex-control/delete/{id}', [ComplexControlController::class, 'delete']);

Route::post('/complex-fees/create', [ComplexFeesController::class, 'create']);
Route::get('/complex-fees/getAll', [ComplexFeesController::class, 'getAll']);
Route::get('/complex-fees/getByID/{id}', [ComplexFeesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-fees/update', [ComplexFeesController::class, 'update']);
Route::post('/complex-fees/delete/{id}', [ComplexFeesController::class, 'delete']);

Route::post('/complex-types/create', [ComplexTypesController::class, 'create']);
Route::get('/complex-types/getAll', [ComplexTypesController::class, 'getAll']);
Route::get('/complex-types/getByID/{id}', [ComplexTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-types/update', [ComplexTypesController::class, 'update']);
Route::post('/complex-types/delete/{id}', [ComplexTypesController::class, 'delete']);

Route::post('/complex-fee-types/create', [ComplexFeeTypesController::class, 'create']);
Route::get('/complex-fee-types/getAll', [ComplexFeeTypesController::class, 'getAll']);
Route::get('/complex-fee-types/getByID/{id}', [ComplexFeeTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-fee-types/update', [ComplexFeeTypesController::class, 'update']);
Route::post('/complex-fee-types/delete/{id}', [ComplexFeeTypesController::class, 'delete']);

Route::post('/complex-uses/create', [ComplexUsesController::class, 'create']);
Route::get('/complex-uses/getAll', [ComplexUsesController::class, 'getAll']);
Route::get('/complex-uses/getByID/{id}', [ComplexUsesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-uses/update', [ComplexUsesController::class, 'update']);
Route::post('/complex-uses/delete/{id}', [ComplexUsesController::class, 'delete']);

Route::post('/complex-plan/create', [ComplexPlanController::class, 'create']);
Route::get('/complex-plan/getAll', [ComplexPlanController::class, 'getAll']);
Route::get('/complex-plan/getByID/{id}', [ComplexPlanController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-plan/update', [ComplexPlanController::class, 'update']);
Route::post('/complex-plan/delete/{id}', [ComplexPlanController::class, 'delete']);

Route::post('/complex-provider/create', [ComplexProviderController::class, 'create']);
Route::get('/complex-provider/getAll', [ComplexProviderController::class, 'getAll']);
Route::get('/complex-provider/getByID/{id}', [ComplexProviderController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-provider/update', [ComplexProviderController::class, 'update']);
Route::post('/complex-provider/delete/{id}', [ComplexProviderController::class, 'delete']);

Route::post('/complex-administrations/create', [ComplexAdministrationsController::class, 'create']);
Route::get('/complex-administrations/getAll', [ComplexAdministrationsController::class, 'getAll']);
Route::get('/complex-administrations/getByID/{id}', [ComplexAdministrationsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-administrations/update', [ComplexAdministrationsController::class, 'update']);
Route::post('/complex-administrations/delete/{id}', [ComplexAdministrationsController::class, 'delete']);

Route::post('/complex-admin-types/create', [ComplexAdministrationTypesController::class, 'create']);
Route::get('/complex-admin-types/getAll', [ComplexAdministrationTypesController::class, 'getAll']);
Route::get('/complex-admin-types/getByID/{id}', [ComplexAdministrationTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-admin-types/update', [ComplexAdministrationTypesController::class, 'update']);
Route::post('/complex-admin-types/delete/{id}', [ComplexAdministrationTypesController::class, 'delete']);

Route::post('/complex-admin-roles/create', [ComplexAdministrationRolesController::class, 'create']);
Route::get('/complex-admin-roles/getAll', [ComplexAdministrationRolesController::class, 'getAll']);
Route::get('/complex-admin-roles/getByID/{id}', [ComplexAdministrationRolesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-admin-roles/update', [ComplexAdministrationRolesController::class, 'update']);
Route::post('/complex-admin-roles/delete/{id}', [ComplexAdministrationRolesController::class, 'delete']);

Route::post('/complex-balance-accounts/create', [ComplexBalanceAccountsController::class, 'create']);
Route::get('/complex-balance-accounts/getAll', [ComplexBalanceAccountsController::class, 'getAll']);
Route::get('/complex-balance-accounts/getByID/{id}', [ComplexBalanceAccountsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-balance-accounts/update', [ComplexBalanceAccountsController::class, 'update']);
Route::post('/complex-balance-accounts/delete/{id}', [ComplexBalanceAccountsController::class, 'delete']);

Route::post('/complex-balance-config/create', [ComplexBalanceConfigController::class, 'create']);
Route::get('/complex-balance-config/getAll', [ComplexBalanceConfigController::class, 'getAll']);
Route::get('/complex-balance-config/getByID/{id}', [ComplexBalanceConfigController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-balance-config/update', [ComplexBalanceConfigController::class, 'update']);
Route::post('/complex-balance-config/delete/{id}', [ComplexBalanceConfigController::class, 'delete']);

Route::post('/complex-balance-withdrawals/create', [ComplexBalanceWithdrawalsController::class, 'create']);
Route::get('/complex-balance-withdrawals/getAll', [ComplexBalanceWithdrawalsController::class, 'getAll']);
Route::get('/complex-balance-withdrawals/getByID/{id}', [ComplexBalanceWithdrawalsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-balance-withdrawals/update', [ComplexBalanceWithdrawalsController::class, 'update']);
Route::post('/complex-balance-withdrawals/delete/{id}', [ComplexBalanceWithdrawalsController::class, 'delete']);

Route::post('/complex-balance-payments/create', [ComplexBalancePaymentsController::class, 'create']);
Route::get('/complex-balance-payments/getAll', [ComplexBalancePaymentsController::class, 'getAll']);
Route::get('/complex-balance-payments/getByID/{id}', [ComplexBalancePaymentsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/complex-balance-payments/update', [ComplexBalancePaymentsController::class, 'update']);
Route::post('/complex-balance-payments/delete/{id}', [ComplexBalancePaymentsController::class, 'delete']);

Route::post('/agreement/create', [AgreementsController::class, 'create']);
Route::get('/agreement/getAll', [AgreementsController::class, 'getAll']);
Route::get('/agreement/getByID/{id}', [AgreementsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/agreement/update', [AgreementsController::class, 'update']);
Route::post('/agreement/delete/{id}', [AgreementsController::class, 'delete']);

Route::post('/agreement-payments/create', [AgreementPaymentsController::class, 'create']);
Route::get('/agreement-payments/getAll', [AgreementPaymentsController::class, 'getAll']);
Route::get('/agreement-payments/getByID/{id}', [AgreementPaymentsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/agreement-payments/update', [AgreementPaymentsController::class, 'update']);
Route::post('/agreement-payments/delete/{id}', [AgreementPaymentsController::class, 'delete']);

Route::post('/notifications/create', [NotificationsController::class, 'create']);
Route::get('/notifications/getAll', [NotificationsController::class, 'getAll']);
Route::get('/notifications/getByID/{id}', [NotificationsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/notifications/update', [NotificationsController::class, 'update']);
Route::post('/notifications/delete/{id}', [NotificationsController::class, 'delete']);

Route::post('/user/create', [UsersController::class, 'create']);
Route::get('/user/getAll', [UsersController::class, 'getAll']);
Route::get('/user/getByID/{id}', [UsersController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user/update', [UsersController::class, 'update']);
Route::post('/user/delete/{id}', [UsersController::class, 'delete']);

Route::post('/user-balance/create', [UserBalanceController::class, 'create']);
Route::get('/user-balance/getAll', [UserBalanceController::class, 'getAll']);
Route::get('/user-balance/getByID/{id}', [UserBalanceController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-balance/update', [UserBalanceController::class, 'update']);
Route::post('/user-balance/delete/{id}', [UserBalanceController::class, 'delete']);

Route::post('/user-balance-transactions/create', [UserBalanceTransactionsController::class, 'create']);
Route::get('/user-balance-transactions/getAll', [UserBalanceTransactionsController::class, 'getAll']);
Route::get('/user-balance-transactions/getByID/{id}', [UserBalanceTransactionsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-balance-transactions/update', [UserBalanceTransactionsController::class, 'update']);
Route::post('/user-balance-transactions/delete/{id}', [UserBalanceTransactionsController::class, 'delete']);

Route::post('/user-cards/create', [UserCardsController::class, 'create']);
Route::get('/user-cards/getAll', [UserCardsController::class, 'getAll']);
Route::get('/user-cards/getByID/{id}', [UserCardsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-cards/update', [UserCardsController::class, 'update']);
Route::post('/user-cards/delete/{id}', [UserCardsController::class, 'delete']);

Route::post('/user-mercadopago/create', [UserMercadopagoController::class, 'create']);
Route::get('/user-mercadopago/getAll', [UserMercadopagoController::class, 'getAll']);
Route::get('/user-mercadopago/getByID/{id}', [UserMercadopagoController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-mercadopago/update', [UserMercadopagoController::class, 'update']);
Route::post('/user-mercadopago/delete/{id}', [UserMercadopagoController::class, 'delete']);

Route::post('/user-mercadopago-cards/create', [UserMercadopagoCardsController::class, 'create']);
Route::get('/user-mercadopago-cards/getAll', [UserMercadopagoCardsController::class, 'getAll']);
Route::get('/user-mercadopago-cards/getByID/{id}', [UserMercadopagoCardsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-mercadopago-cards/update', [UserMercadopagoCardsController::class, 'update']);
Route::post('/user-mercadopago-cards/delete/{id}', [UserMercadopagoCardsController::class, 'delete']);

Route::post('/user-password-resets/create', [UserPasswordResetsController::class, 'create']);
Route::get('/user-password-resets/getAll', [UserPasswordResetsController::class, 'getAll']);
Route::get('/user-password-resets/getByID/{id}', [UserPasswordResetsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-password-resets/update', [UserPasswordResetsController::class, 'update']);
Route::post('/user-password-resets/delete/{id}', [UserPasswordResetsController::class, 'delete']);

Route::post('/user-push-tokens/create', [UserPushTokensController::class, 'create']);
Route::get('/user-push-tokens/getAll', [UserPushTokensController::class, 'getAll']);
Route::get('/user-push-tokens/getByID/{id}', [UserPushTokensController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-push-tokens/update', [UserPushTokensController::class, 'update']);
Route::post('/user-push-tokens/delete/{id}', [UserPushTokensController::class, 'delete']);

Route::post('/user-sessions/create', [UserSessionsController::class, 'create']);
Route::get('/user-sessions/getAll', [UserSessionsController::class, 'getAll']);
Route::get('/user-sessions/getByID/{id}', [UserSessionsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-sessions/update', [UserSessionsController::class, 'update']);
Route::post('/user-sessions/delete/{id}', [UserSessionsController::class, 'delete']);

Route::post('/user-types/create', [UserTypesController::class, 'create']);
Route::get('/user-types/getAll', [UserTypesController::class, 'getAll']);
Route::get('/user-types/getByID/{id}', [UserTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/user-types/update', [UserTypesController::class, 'update']);
Route::post('/user-types/delete/{id}', [UserTypesController::class, 'delete']);


Route::post('/accounts/create', [AccountsController::class, 'create']);
Route::get('/accounts/getAll', [AccountsController::class, 'getAll']);
Route::get('/accounts/getByID/{id}', [AccountsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/accounts/update', [AccountsController::class, 'update']);
Route::post('/accounts/delete/{id}', [AccountsController::class, 'delete']);

Route::post('/provider-categories/create', [ProviderCategoryController::class, 'create']);
Route::get('/provider-categories/getAll', [ProviderCategoryController::class, 'getAll']);
Route::get('/provider-categories/getByID/{id}', [ProviderCategoryController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/provider-categories/update', [ProviderCategoryController::class, 'update']);
Route::post('/provider-categories/delete/{id}', [ProviderCategoryController::class, 'delete']);

Route::post('/provider-accounts/create', [ProviderAccountsController::class, 'create']);
Route::get('/provider-accounts/getAll', [ProviderAccountsController::class, 'getAll']);
Route::get('/provider-accounts/getByID/{id}', [ProviderAccountsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/provider-accounts/update', [ProviderAccountsController::class, 'update']);
Route::post('/provider-accounts/delete/{id}', [ProviderAccountsController::class, 'delete']);

Route::post('/provider-tax-data/create', [ComplexProviderTaxDataController::class, 'create']);
Route::get('/provider-tax-data/getAll', [ComplexProviderTaxDataController::class, 'getAll']);
Route::get('/provider-tax-data/getByID/{id}', [ComplexProviderTaxDataController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/provider-tax-data/update', [ComplexProviderTaxDataController::class, 'update']);
Route::post('/provider-tax-data/delete/{id}', [ComplexProviderTaxDataController::class, 'delete']);

Route::post('/common-area/create', [CommonAreaController::class, 'create']);
Route::get('/common-area/getAll', [CommonAreaController::class, 'getAll']);
Route::get('/common-area/getByID/{id}', [CommonAreaController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/common-area/update', [CommonAreaController::class, 'update']);
Route::post('/common-area/delete/{id}', [CommonAreaController::class, 'delete']);

Route::post('/common-area-reservations/create', [CommonAreaReservationsController::class, 'create']);
Route::get('/common-area-reservations/getAll', [CommonAreaReservationsController::class, 'getAll']);
Route::get('/common-area-reservations/getByID/{id}', [CommonAreaReservationsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/common-area-reservations/update', [CommonAreaReservationsController::class, 'update']);
Route::post('/common-area-reservations/delete/{id}', [CommonAreaReservationsController::class, 'delete']);

Route::post('/news/create', [NewsController::class, 'create']);
Route::get('/news/getAll', [NewsController::class, 'getAll']);
Route::get('/news/getByID/{id}', [NewsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/news/update', [NewsController::class, 'update']);
Route::post('/news/delete/{id}', [NewsController::class, 'delete']);

Route::post('/news-views/create', [NewsViewsController::class, 'create']);
Route::get('/news-views/getAll', [NewsViewsController::class, 'getAll']);
Route::get('/news-views/getByID/{id}', [NewsViewsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/news-views/update', [NewsViewsController::class, 'update']);
Route::post('/news-views/delete/{id}', [NewsViewsController::class, 'delete']);

Route::post('/addresses/create', [AddressesController::class, 'create']);
Route::get('/addresses/getAll', [AddressesController::class, 'getAll']);
Route::get('/addresses/getByID/{id}', [AddressesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/addresses/update', [AddressesController::class, 'update']);
Route::post('/addresses/delete/{id}', [AddressesController::class, 'delete']);

Route::post('/banks/create', [BanksController::class, 'create']);
Route::get('/banks/getAll', [BanksController::class, 'getAll']);
Route::get('/banks/getByID/{id}', [BanksController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/banks/update', [BanksController::class, 'update']);
Route::post('/banks/delete/{id}', [BanksController::class, 'delete']);

Route::post('/configurations/create', [ConfigurationsController::class, 'create']);
Route::get('/configurations/getAll', [ConfigurationsController::class, 'getAll']);
Route::get('/configurations/getByID/{id}', [ConfigurationsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/configurations/update', [ConfigurationsController::class, 'update']);
Route::post('/configurations/delete/{id}', [ConfigurationsController::class, 'delete']);

Route::post('/failed-jobs/create', [FailedJobsController::class, 'create']);
Route::get('/failed-jobs/getAll', [FailedJobsController::class, 'getAll']);
Route::get('/failed-jobs/getByID/{id}', [FailedJobsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/failed-jobs/update', [FailedJobsController::class, 'update']);
Route::post('/failed-jobs/delete/{id}', [FailedJobsController::class, 'delete']);

Route::post('/methods/create', [MethodsController::class, 'create']);
Route::get('/methods/getAll', [MethodsController::class, 'getAll']);
Route::get('/methods/getByID/{id}', [MethodsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/methods/update', [MethodsController::class, 'update']);
Route::post('/methods/delete/{id}', [MethodsController::class, 'delete']);

Route::post('/oxxo-orders/create', [OxxoOrdersController::class, 'create']);
Route::get('/oxxo-orders/getAll', [OxxoOrdersController::class, 'getAll']);
Route::get('/oxxo-orders/getByID/{id}', [OxxoOrdersController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/oxxo-orders/update', [OxxoOrdersController::class, 'update']);
Route::post('/oxxo-orders/delete/{id}', [OxxoOrdersController::class, 'delete']);

Route::post('/oxxo-order-payments/create', [OxxoOrderPaymentsController::class, 'create']);
Route::get('/oxxo-order-payments/getAll', [OxxoOrderPaymentsController::class, 'getAll']);
Route::get('/oxxo-order-payments/getByID/{id}', [OxxoOrderPaymentsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/oxxo-order-payments/update', [OxxoOrderPaymentsController::class, 'update']);
Route::post('/oxxo-order-payments/delete/{id}', [OxxoOrderPaymentsController::class, 'delete']);

Route::post('/payment-providers/create', [PaymentProvidersController::class, 'create']);
Route::get('/payment-providers/getAll', [PaymentProvidersController::class, 'getAll']);
Route::get('/payment-providers/getByID/{id}', [PaymentProvidersController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/payment-providers/update', [PaymentProvidersController::class, 'update']);
Route::post('/payment-providers/delete/{id}', [PaymentProvidersController::class, 'delete']);

Route::post('/payment-types/create', [PaymentTypesController::class, 'create']);
Route::get('/payment-types/getAll', [PaymentTypesController::class, 'getAll']);
Route::get('/payment-types/getByID/{id}', [PaymentTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/payment-types/update', [PaymentTypesController::class, 'update']);
Route::post('/payment-types/delete/{id}', [PaymentTypesController::class, 'delete']);

Route::post('/properties/create', [PropertiesController::class, 'create']);
Route::get('/properties/getAll', [PropertiesController::class, 'getAll']);
Route::get('/properties/getByID/{id}', [PropertiesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/properties/update', [PropertiesController::class, 'update']);
Route::post('/properties/delete/{id}', [PropertiesController::class, 'delete']);

Route::post('/property-types/create', [PropertyTypesController::class, 'create']);
Route::get('/property-types/getAll', [PropertyTypesController::class, 'getAll']);
Route::get('/property-types/getByID/{id}', [PropertyTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/property-types/update', [PropertyTypesController::class, 'update']);
Route::post('/property-types/delete/{id}', [PropertyTypesController::class, 'delete']);

Route::post('/property-guests/create', [PropertyGuestsController::class, 'create']);
Route::get('/property-guests/getAll', [PropertyGuestsController::class, 'getAll']);
Route::get('/property-guests/getByID/{id}', [PropertyGuestsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/property-guests/update', [PropertyGuestsController::class, 'update']);
Route::post('/property-guests/delete/{id}', [PropertyGuestsController::class, 'delete']);

Route::post('/support-tickets/create', [SupportTicketsController::class, 'create']);
Route::get('/support-tickets/getAll', [SupportTicketsController::class, 'getAll']);
Route::get('/support-tickets/getByID/{id}', [SupportTicketsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/support-tickets/update', [SupportTicketsController::class, 'update']);
Route::post('/support-tickets/delete/{id}', [SupportTicketsController::class, 'delete']);

Route::post('/tags/create', [TagsController::class, 'create']);
Route::get('/tags/getAll', [TagsController::class, 'getAll']);
Route::get('/tags/getByID/{id}', [TagsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/tags/update', [TagsController::class, 'update']);
Route::post('/tags/delete/{id}', [TagsController::class, 'delete']);

Route::post('/tag-types/create', [TagTypesController::class, 'create']);
Route::get('/tag-types/getAll', [TagTypesController::class, 'getAll']);
Route::get('/tag-types/getByID/{id}', [TagTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/tag-types/update', [TagTypesController::class, 'update']);
Route::post('/tag-types/delete/{id}', [TagTypesController::class, 'delete']);

Route::post('/tag-statuses/create', [TagStatusesController::class, 'create']);
Route::get('/tag-statuses/getAll', [TagStatusesController::class, 'getAll']);
Route::get('/tag-statuses/getByID/{id}', [TagStatusesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/tag-statuses/update', [TagStatusesController::class, 'update']);
Route::post('/tag-statuses/delete/{id}', [TagStatusesController::class, 'delete']);

Route::post('/vehicle/create', [VehiclesController::class, 'create']);
Route::get('/vehicle/getAll', [VehiclesController::class, 'getAll']);
Route::get('/vehicle/getByID/{id}', [VehiclesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/vehicle/update', [VehiclesController::class, 'update']);
Route::post('/vehicle/delete/{id}', [VehiclesController::class, 'delete']);

Route::post('/vehicle-types/create', [VehicleTypesController::class, 'create']);
Route::get('/vehicle-types/getAll', [VehicleTypesController::class, 'getAll']);
Route::get('/vehicle-types/getByID/{id}', [VehicleTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/vehicle-types/update', [VehicleTypesController::class, 'update']);
Route::post('/vehicle-types/delete/{id}', [VehicleTypesController::class, 'delete']);

Route::post('/guest/create', [GuestsController::class, 'create']);
Route::get('/guest/getAll', [GuestsController::class, 'getAll']);
Route::get('/guest/getByID/{id}', [GuestsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/guest/update', [GuestsController::class, 'update']);
Route::post('/guest/delete/{id}', [GuestsController::class, 'delete']);

Route::post('/guest-access/create', [GuestAccessControlController::class, 'create']);
Route::get('/guest-access/getAll', [GuestAccessControlController::class, 'getAll']);
Route::get('/guest-access/getByID/{id}', [GuestAccessControlController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/guest-access/update', [GuestAccessControlController::class, 'update']);
Route::post('/guest-access/delete/{id}', [GuestAccessControlController::class, 'delete']);

Route::post('/conceded-types/create', [GuestAccessControlConcededTypesController::class, 'create']);
Route::get('/conceded-types/getAll', [GuestAccessControlConcededTypesController::class, 'getAll']);
Route::get('/conceded-types/getByID/{id}', [GuestAccessControlConcededTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/conceded-types/update', [GuestAccessControlConcededTypesController::class, 'update']);
Route::post('/conceded-types/delete/{id}', [GuestAccessControlConcededTypesController::class, 'delete']);

Route::post('/document-types/create', [GuestAccessControlDocumentTypesController::class, 'create']);
Route::get('/document-types/getAll', [GuestAccessControlDocumentTypesController::class, 'getAll']);
Route::get('/document-types/getByID/{id}', [GuestAccessControlDocumentTypesController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/document-types/update', [GuestAccessControlDocumentTypesController::class, 'update']);
Route::post('/document-types/delete/{id}', [GuestAccessControlDocumentTypesController::class, 'delete']);

Route::post('/guest-access-documents/create', [GuestAccessControlDocumentsController::class, 'create']);
Route::get('/guest-access-documents/getAll', [GuestAccessControlDocumentsController::class, 'getAll']);
Route::get('/guest-access-documents/getByID/{id}', [GuestAccessControlDocumentsController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/guest-access-documents/update', [GuestAccessControlDocumentsController::class, 'update']);
Route::post('/guest-access-documents/delete/{id}', [GuestAccessControlDocumentsController::class, 'delete']);

Route::post('/lost-objects/create', [LostObjectsControlController::class, 'create']);
Route::get('/lost-objects/getAll', [LostObjectsControlController::class, 'getAll']);
Route::get('/lost-objects/getByID/{id}', [LostObjectsControlController::class, 'getByID'])
    ->where('id', '[0-9]+');
Route::put('/lost-objects/update', [LostObjectsControlController::class, 'update']);
Route::post('/lost-objects/delete/{id}', [LostObjectsControlController::class, 'delete']);
