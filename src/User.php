<?php

namespace Moehrenzahn\Toolkit;

/**
 * Class User
 *
 * @package Moehrenzahn\Toolkit\User
 */
class User
{
    /**
     * Wrapper around wp_insert_user. Creates an abstract user without email, username or password.
     * Will store image id in simple_local_avatar user meta.
     *
     * Returns created user's id.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $description
     * @param int|null $imageId
     * @return int|\WP_Error
     */
    public function createUser(string $firstName, string $lastName, string $description, int $imageId = null)
    {
        $data = [
            'user_login' => implode(' ', [$firstName, $lastName]),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'display_name' => implode(' ', [$firstName, $lastName]),
            'description' => $description,
            'role' => 'author',
        ];
        $userId = wp_insert_user($data);
        if ($imageId && is_int($userId)) {
            $this->addLocalAvatar($userId, $imageId);
        }

        return $userId;
    }

    /**
     * @param int $userId
     * @param int $imageId
     */
    private function addLocalAvatar(int $userId, int $imageId)
    {
        update_user_meta(
            $userId,
            'simple_local_avatar',
            [
                'media_id' => $imageId,
                'full' => wp_get_attachment_url($imageId)
            ]
        );
    }
}
