<?php

namespace App\Services\Managers;

use App\Entity\NewsletterUser;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class NewsletterUserManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * NewsletterUserManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param NewsletterUser $user
     * @return bool
     */
    public function save(NewsletterUser $user): bool
    {
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param NewsletterUser $user
     * @return bool
     */
    public function delete(NewsletterUser $user): bool
    {
        try {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
