<?php

namespace App\Http\Requests\Api;

use App\Enum\ServiceShopEnum;
use App\Enum\StrategyShopEnum;
use App\Traits\IdentifierTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

/**
 * @property mixed $url
 */
class GetProductRequest extends FormRequest
{
    use IdentifierTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'url' => ['string'],
            'entity' => ['string', Rule::in(ServiceShopEnum::values())],
            'type' => ['string', Rule::in(StrategyShopEnum::names())],
        ];
    }

    public function checkRegex()
    {

        if (!$this->check($this->url)) {
            throw new InvalidArgumentException("Url is not valid.");
        };
    }
}
