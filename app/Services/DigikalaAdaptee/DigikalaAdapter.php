<?php

namespace App\Services\DigikalaAdaptee;

use App\Enum\ServiceShopEnum;
use App\Services\DigikalaAdaptee\Concerns\ResponseTrait;
use App\Services\DigikalaAdaptee\Contracts\AdapteeInterface;
use App\Services\DigikalaAdaptee\Contracts\DigikalaAdapterInterface;
use App\Traits\IdentifierTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use InvalidArgumentException;

class DigikalaAdapter implements DigikalaAdapterInterface
{
    use ResponseTrait;
    use IdentifierTrait;

    protected AdapteeInterface $adaptee;
    protected string $identifier;

    /**
     * @throws BindingResolutionException
     */
    public function setAdaptee(string $service): static
    {
        if (!$this->checkService($service)) {
            throw new InvalidArgumentException($service . " Service Not Founded");
        };
        $this->adaptee = app()->make(config('digikala.drivers.' . $service));
        return $this;
    }

    public function setIdentifier(string $identifier): static
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function category()
    {
        $url = $this->LinkWithCategory($this->identifier);
        return $this->adaptee->category($url);

    }

    public function product()
    {
        $productId = $this->check($this->identifier);
        $url = $this->LinkWithProductId($productId);
        return $this->adaptee->product($url);
    }

    public function search(int $page)
    {
        $url = $this->linkForSearch($this->identifier, $page);
        return $this->adaptee->search($url);
    }

    private function checkService(string $service): bool
    {

        return in_array($service, ServiceShopEnum::values());
    }

    private function LinkWithProductId(int $id): string
    {
        return config('shop.DIGIKALA.api_url') . 'product/' . $id . '/';
    }

    private function LinkWithCategory(string $identifier): string
    {
        return config('shop.DIGIKALA.api_url') . 'categories/' . $identifier . '/search/';

    }

    private function linkForSearch(string $identifier, $page): string
    {
        return config('shop.DIGIKALA.api_url') . 'search/?q=' . $identifier . '&page=' . $page;
    }


}
