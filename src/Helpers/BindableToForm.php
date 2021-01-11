<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Tags\Form;

/**
 * Trait BindableToForm.
 * Add this trait to any custom Tag implementation to make it bindable to a Form.
 * It uses a simple binding with HTML 'form' attribute.
 *
 * @package Nethead\Markup\Helpers
 */
trait BindableToForm {
    /**
     * Bind the element to form.
     *
     * @see Form
     * @param Form $form Form object to bind to
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