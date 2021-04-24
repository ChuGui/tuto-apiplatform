<?php


namespace App\Controller;


use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;

class PostCountController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(Request $request): int
    {
        $onlineQuery = $request->get('online');
        $conditions = [];

        if($onlineQuery !== null) {
            $conditions = [ 'online' => $onlineQuery === '1'];
        }

        return $this->postRepository->count($conditions);
    }
}
