<?php


namespace App\Helpers;


use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\NotesCollection;
use AmoCRM\Collections\TasksCollection;
use AmoCRM\EntitiesServices\Contacts;
use AmoCRM\EntitiesServices\Leads;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Filters\ContactsFilter;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Filters\TagsFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFields\CustomFieldModel;
use AmoCRM\Models\CustomFieldsValues\BaseCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\DateCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\NumericCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\SelectCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\DateCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\NumericCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\DateCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\UrlCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\NumericCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\NoteType\CommonNote;
use AmoCRM\Models\TaskModel;
use App\Models\AuthData;
use App\Models\Order;
use App\Models\OrderAccessory;
use App\Models\OrderItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

use function reset;

class AmoCRMHelper
{
    /**
     * @var AmoCRMApiClient
     */
    private $amoCrmClient;


    public function __construct()
    {
        $this->amoCrmClient = new AmoCRMApiClient(123, '12312123', 'qweqweqw');
        $this->authorize();
    }

    /**
     * @return void
     */
    private function authorize(): void
    {
        $response = Http::withHeaders([
            'X-Client-Id' => env('X_CLIENT_ID')
        ])->withoutVerifying()->get('https://test.gnzs.ru/oauth/get-token.php');


        $this->amoCrmClient->setAccountBaseDomain($response->json()['base_domain']);
        $token = new AccessToken(
            [
                'baseDomain' => $response->json()['base_domain'],
                'expires' => time() + 60*60,
                'access_token' => $response->json()['access_token']
            ]
        );
        $this->amoCrmClient->setAccessToken($token);
    }

    /**
     * @return AmoCRMApiClient
     */
    public function getAmoCRMApiClient(): AmoCRMApiClient
    {
        return $this->amoCrmClient;
    }

}
