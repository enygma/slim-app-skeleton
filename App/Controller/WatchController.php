<?php

namespace App\Controller;
use App\Lib\Connector\Twitch;
use App\Lib\Connector\Twitter;

use App\Model\Watch;
use App\Model\Connector;
use App\Model\Target;

class WatchController extends \App\Controller\BaseController
{
    public function index()
    {
        $data = [
            'watches' => Watch::all()
        ];
        return $this->render('/watch/index.php', $data);
    }

    public function create()
    {
        $this->user->load('connectors');
        $data = [
            'connectors' => $this->user->connectors
        ];
        return $this->render('/watch/create.php', $data);
    }

    public function createSubmit($request)
    {
        $data = [
            'messages' => ['errors' => [], 'success' => []],
            'connectors' => $this->user->connectors
        ];
        // Verify our submission first
        $result = $this->verify($request, [
            'username' => 'required',
            'post_to' => 'required'
        ]);

        if ($result === false) {
            $data['messages']['errors'] = array_merge($data['messages']['errors'], $this->validator->errorArray());
        } else {
            // Good to go
            $watch = Watch::create([
                'username' => $request->getParam('username'),
                'user_id' => $this->user->id
            ]);

            $postTo = $request->getParam('post_to');
            foreach ($postTo as $target) {
                Target::create([
                    'connector_id' => $target,
                    'watch_id' => $watch->id
                ]);
            }
        }

        return $this->render('/watch/create.php', $data);
    }

    public function delete($request, $response, $args)
    {
        $watch = Watch::find($args['id']);

        // Remove related targets
        Target::where(['watch_id' => $watch->id])->delete();

        // Now the watch itself
        $watch->delete();

        return $this->jsonSuccess('Watch removed successfully');
    }
}
