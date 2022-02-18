<?php

namespace backend\lists;

use core\entities\State;
use core\entities\StateCategory;
use core\forms\StateUpdateForm;
use core\helpers\StatusHelper;

class StateList
{
    public static function serializeListItem(State $state)
    {
        return [
            'category' => [
                'id' => $state->category->id,
                'title' => $state->category->title,
                'status' => StatusHelper::status($state->category->status, StateCategory::class)
            ],
            'id' => $state->id,
            'title' => $state->title,
            'recommendation' => $state->title_recommendation,
            'content' => $state->content,
            'status' => StatusHelper::status($state->status, new State()),
            'image' => $state->getThumbFileUrl('image', 'catalog_list')
        ];
    }

    public static function serializeListState(State $state)
    {
        return [
            'title' => $state->title,
            'recommendation' => $state->title_recommendation,
            'content' => $state->content,
            'status' => StatusHelper::status($state->status, new State()),
            'image' => $state->getThumbFileUrl('image', 'catalog_list')
        ];
    }

    public static function formListCategory(StateCategory $category)
    {
        return [
            'id' => $category->id,
            'title' => $category->title
        ];
    }

    public static function formState(StateUpdateForm $form)
    {
        return [
            'title' => $form->title,
            'title_recommendation' => $form->title_recommendation,
            'content' => $form->content,
            'category' => $form->category,
            'status' => $form->status,
        ];
    }
}