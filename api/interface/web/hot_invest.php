<?php
class InterfaceWebHotInvest extends controller
{

    private $error = array();

    public function index(){

        // Retrieves all robots
        $app = $this->app;
        $this->app->get('/web/hot_invest', function () use ($app) {


            $phql = "SELECT w.*,wc.* FROM Web w Left Join Webcategory wc ON w.status = wc.status";
            $robots = $app->modelsManager->executeQuery($phql);
            error_log(print_r($robots, true));
            $data = array();

            foreach ($robots as $robot) {
                $data[] = array(
                    'press_id' => $robot->w->press_id
                );
            }

            echo json_encode($data);

        });

        $app->handle();

    }

    public function add()
    {
        $app = $this->app;

        // Adds a new robot
        $app->post('/web/hot_invest/add', function () use ($app) {

            $robot = $app->request->getJsonRawBody();

            $phql = "INSERT INTO Hotinvest (name, mobile, city,create_time) VALUES (:name:, :mobile:, :city:, :create_time:)";

            $status = $app->modelsManager->executeQuery($phql, array(
                'name' => $robot->name,
                'mobile' => $robot->mobile,
                'city' => $robot->city,
                'create_time' => date('Y-m-d H:i:s')
            ));
            // Create a response
            $response = $app->response;

            // Check if the insertion was successful
            if ($status->success() == true) {

                // Change the HTTP status
                $response->setStatusCode(201, "Created");

                $robot->id = $status->getModel()->id;

                $response->setJsonContent(
                    array(
                        'status' => 'OK',
                        'data' => $robot
                    )
                );

            } else {

                // Change the HTTP status
                $response->setStatusCode(409, "Conflict");

                // Send errors to the client
                $errors = array();
                foreach ($status->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(
                    array(
                        'status' => 'ERROR',
                        'messages' => $errors
                    )
                );
            }

            return $response;


        });
        $app->handle();
   }
}


