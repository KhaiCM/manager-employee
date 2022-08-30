<?php

namespace App\Services;

use App\Contracts\FormRepositoryInterface;

class FormService
{
    protected $formRepository;

    /**
     * Create a new ImportService instance.
     *
     * FormRepositoryInterface $formRepository
     * @return void
     */
    public function __construct(
        FormRepositoryInterface $formRepository,
    ) {
        $this->formRepository = $formRepository;
    }

    /**
     * Get list of forms.
     *
     * @return mixed
     */
    public function getListOfForms()
    {
        return $this->formRepository->all();
    }
}
