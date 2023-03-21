<?php

namespace App\Services\Dashboard;

use App\Repositories\Information\IInformationRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\UserPayment\IUserPaymentRepository;
use App\Repositories\Video\IVideoRepository;

class DashboardService implements IDashboardService
{

    protected IUserRepository $userRepo;

    protected IVideoRepository $videoRepo;

    protected IInformationRepository $infoRepo;

    protected IUserPaymentRepository $userPaymentRepo;

    public function __construct(
        IUserRepository $userRepo,
        IVideoRepository $videoRepo,
        IInformationRepository $infoRepo,
        IUserPaymentRepository $userPaymentRepo

    ) {
        $this->userRepo = $userRepo;
        $this->videoRepo = $videoRepo;
        $this->infoRepo = $infoRepo;
        $this->userPaymentRepo = $userPaymentRepo;

        $this->loadComponents();
    }

    public function index()
    {
        $response['usersContributed'] = $this->getUserContributed();
        return $response;
    }

    public function totalUsers()
    {
        return  $this->userRepo->countUsers();
    }

    public function totalVideos()
    {
        return $this->videoRepo->countVideos();
    }

    public function totalInfos()
    {
        return $this->infoRepo->countInfo();
    }

    public function getUserRegisterInYear(int $year)
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $monthCollection = $this->userRepo->getUserRegisterInYear($year);
        $existMonths = $monthCollection->pluck('month');

        foreach ($months as $month) {
            if (!$existMonths->contains($month)) {
                $item['month'] = $month;
                $item['user'] = 0;
                $monthCollection->push($item);
            }
        }

        return $monthCollection->sortBy('month');
    }

    public function getUserContributed()
    {
        return $this->infoRepo->getUserContribute();
    }

    public function getUserPaymentSuccess()
    {
        return $this->userPaymentRepo->getUserPaySuccessful();
    }

    public function loadComponents()
    {

        view()->composer('components.card', function ($view) {

            $totalUsers = $this->totalUsers();
            $totalVideos = $this->totalVideos();
            $totalInfos = $this->totalInfos();
            $money = $this->getUserPaymentSuccess();


            $view->with([
                'totalUsers' => $totalUsers,
                'totalVideos' => $totalVideos,
                'totalInfos' => $totalInfos,
                'money' => $money
            ]);
        });

        view()->composer('pages.dashboard', function ($view) {

            $userRegister = $this->getUserRegisterInYear(2023);

            $view->with([
                'userRegister' => $userRegister
            ]);
        });
    }
}
