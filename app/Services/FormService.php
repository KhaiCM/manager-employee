<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Http\Requests\CreateFormRequest;
use App\Contracts\FormRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Enums\StatusForm;

class FormService
{
    protected $formRepository;
    protected $userRepository;

    /**
     * Create a new FormService instance.
     *
     * @param FormRepositoryInterface $formRepository
     * @return void
     */
    public function __construct(
        FormRepositoryInterface $formRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->formRepository = $formRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new form
     *
     * @param CreateFormRequest $request
     * @return mixed
     */
    public function createNewForm($request)
    {
        return $this->formRepository->create([
            'id' => Str::uuid(),
            'status' => StatusForm::WAITING,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
            'user_id' => auth()->user()->id,
            'm_type_form_id' => $request->m_type_form_id,
        ]);
    }

    /**
     * Delete data of form
     *
     * @param string $id
     * @return mixed
     */
    public function deleteFormByID($id)
    {
        return $this->formRepository->delete($id);
    }

    /**
     * Get a list of forms
     *
     * @return mixed
     */
    public function getListOfForms()
    {
        return $this->formRepository->all();
    }

    /**
     * Get a list of forms belong to user
     *
     * @param int $userId
     * @return mixed
     */
    public function getListOfFormsByUser($userId)
    {
        return $this->formRepository->getFormsByUser($userId);
    }
}
