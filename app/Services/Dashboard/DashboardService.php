<?php

namespace App\Services\Dashboard;

use App\Repositories\Information\IInformationRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\Video\IVideoRepository;

class DashboardService implements IDashboardService
{

    protected IUserRepository $userRepo;
    protected IVideoRepository $videoRepo;
    protected IInformationRepository $infoRepo;

    public function __construct(
        IUserRepository $userRepo,
        IVideoRepository $videoRepo,
        IInformationRepository $infoRepo
    ) {
        $this->userRepo = $userRepo;
        $this->videoRepo = $videoRepo;
        $this->infoRepo = $infoRepo;

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

    public function getUserContributed()
    {
        return $this->infoRepo->getUserContribute();
    }

    public function loadComponents()
    {
        view()->composer('components.card', function ($view) {

            $totalUsers = $this->totalUsers();
            $totalVideos = $this->totalVideos();
            $totalInfos = $this->totalInfos();

            $view->with([
                'totalUsers' => $totalUsers,
                'totalVideos' => $totalVideos,
                'totalInfos' => $totalInfos
            ]);
        });
    }
}
