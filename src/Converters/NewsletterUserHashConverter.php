<?php

namespace App\Converters;

use App\Repository\NewsletterUserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NewsletterUserHashConverter
 * @package App\Converters
 */
class NewsletterUserHashConverter implements ParamConverterInterface
{
    /**
     * @var NewsletterUserRepository
     */
    private $newsletterUserRepository;

    /**
     * NewsletterUserHashConverter constructor.
     */
    public function __construct(NewsletterUserRepository $newsletterUserRepository)
    {
        $this->newsletterUserRepository = $newsletterUserRepository;
    }

    /**
     * @param Request        $request
     * @param ParamConverter $configuration
     * @return bool
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        if (!$hash = $request->get('hash')) {
            return false;
        }

        if (!$user = $this->newsletterUserRepository->findOneBy([ 'hash' => $hash ])) {
            return false;
        }

        $request->attributes->set('user', $user);

        return true;
    }

    /**
     * @param ParamConverter $configuration
     * @return bool
     */
    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getName() === 'newsletter_user_hash';
    }
}
