<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\LeadModel;
use App\Helpers\AmoCRMHelper;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EntityController extends Controller
{
    /**
     * Выбор сущностей для создания
     */
    const FOR_LEADS = 10;
    const FOR_CONTACTS = 20;
    const FOR_COMPANIES = 30;
    /**
     * @var AmoCRMApiClient
     */
    private $amoClient;

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function createRequest(Request $request): ApiResponse
    {
        try {
            $amo_helper = new AmoCRMHelper();
        } catch (\Exception $e) {
            return ApiResponse::error($e, ApiResponse::HTTP_BAD_REQUEST);
        }

        $this->amoClient = $amo_helper->getAmoCRMApiClient();
        $selected = (int)$request->input('selected_ent');

        try {
            return ApiResponse::success(array_merge(
                [
                    'selected_id' => $selected
                ],
                $this->createHandler($selected)));
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }


    }

    /**
     * @param int $selected
     * @return array
     * @throws \Exception
     */
    private function createHandler(int $selected): array
    {
        switch ($selected) {
            case self::FOR_COMPANIES :
                $response = $this->createCompany();
                break;
            case self::FOR_CONTACTS :
                $response = $this->createContact();
                break;
            case self::FOR_LEADS :
                $response = $this->createLead();
                break;
            default:
                throw new \Exception('No entity for selected="' . $selected . '"');
        }

        return $response;
    }

    /**
     * @return array
     * @throws \AmoCRM\Exceptions\AmoCRMMissedTokenException
     */
    private function createCompany(): array
    {
        $compService = $this->amoClient->companies();

        $company = new CompanyModel();
        $company->setName("ООО GoodTest Inc.");

        try {
            $response = $compService->addOne($company)->toArray();
            Log::debug(__METHOD__ . ' ' . var_export($response, true));
            /** @var CompanyModel $company */
            return [
                'id' => $response['id'],
                'name' => $response['name']
            ];
        } catch (AmoCRMoAuthApiException|AmoCRMApiException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function createContact(): array
    {
        $contService = $this->amoClient->contacts();

        $contact = new ContactModel();
        $contact->setName('Тест Алексей Тестович');

        try {
            $response = $contService->addOne($contact)->toArray();
            Log::debug(__METHOD__ . ' ' . var_export($response, true));
            return [
                'id' => $response['id'],
                'name' => $response['name']
            ];
        } catch (AmoCRMoAuthApiException|AmoCRMApiException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function createLead(): array
    {
        $leadService = $this->amoClient->leads();
        $lead = new LeadModel();
        $lead->setName('Another test Lead');

        try {
            $response = $leadService->addOne($lead)->toArray();
            Log::debug(__METHOD__ . ' ' . var_export($response, true));
            return [
                'id' => $response['id'],
                'name' => $response['name']
            ];
        } catch (AmoCRMoAuthApiException|AmoCRMApiException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
