<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Tags\Form;

/**
 * Trait BindableToForm
 * @package Nethead\Markup\Helpers
 */
trait BindableToForm {
    /**
     * @param Form $form
     * @return $this
     */
    public function bindForm(Form $form)
    {
        $formId = $form->attrs()->get('id');

        if ($formId) {
            $this->attrs()->set('form', $formId);
        }

        return $this;
    }
}