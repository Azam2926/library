<?php

namespace frontend\service;


use common\models\UserDetails;
use frontend\repository\UserDetailsRepository;
use Throwable;
use yii\base\Component;
use yii\db\Exception;


class UserDetailsService extends Component
{

    public UserDetailsRepository $userDetailsRepository;
    public function __construct(
                                UserDetailsRepository $userDetailsRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->userDetailsRepository = $userDetailsRepository;
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function update(UserDetails $model): void
    {
        $userDetailsModel = $this->userDetailsRepository->getByUser();
        $userDetailsModel->firstname = $model->firstname;
        $userDetailsModel->lastname = $model->lastname;
        $userDetailsModel->full_address = $model->full_address;
        $userDetailsModel->home_address = $model->home_address;
        $userDetailsModel->work_address = $model->work_address;
        $userDetailsModel->description = $model->description;
        $userDetailsModel->status = UserDetails::ORDER_CREATE;

        if(!$userDetailsModel->save())
        {
            throw new Exception("Not update user details");
        }
    }



}