<?php

namespace app\models;

use app\types\Task;

class TaskModel extends BaseModel
{
    /**
     * @param Task $newTask
     * @return bool
     */
    public function create(Task $newTask)
    {

        $newUserData = [
            $newTask->getFirstName(), $newTask->getLastName(), $newTask->getEmail()
        ];

        $selectUserData = "SELECT id, first_name, last_name, email
        FROM task_data_user
        WHERE first_name = ? AND last_name = ? AND email = ?";

        $userData = $this->query($selectUserData, $newUserData)->fetchObject();

        try {

            $this->pdo->beginTransaction();

            if (!$userData) {

                $this->query("INSERT INTO task_data_user(`first_name`,`last_name`,`email`) VALUES (?,?,?)", $newUserData);

                $userData = $this->query($selectUserData, $newUserData)->fetchObject();

            }

            $newTaskData = [
                $userData->id, $newTask->getDescription(), $newTask->getImage()->getPath()
            ];

            $this->query("INSERT INTO tasks(`user_data_id`,`description`,`image`) VALUES (?,?,?)", $newTaskData);

            $this->pdo->commit();

            return true;

        } catch (\Exception $exception) {

            $this->pdo->rollBack();
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function findById($id)
    {
        $select = "SELECT *
        FROM tasks JOIN task_data_user
        WHERE tasks.id = ? AND tasks.user_data_id = task_data_user.id";

        $result = $this->query($select, [$id]);

        if ($result) {
            return $result->fetchObject();
        }

        return null;

    }

    public function paginate(int $page, int $limit = 3)
    {

        $total = $this->pdo->query('
                        SELECT
                            COUNT(*)
                        FROM
                            tasks
                    ')->fetchColumn();

        $pages = ceil($total / $limit);

        $offset = ($page - 1) * $limit;

        //$start = $offset + 1;
        //$end = min(($offset + $limit), $total);

        // The "back" link
        //$prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

        // The "forward" link
        //$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

        // Display the paging information
        //echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

        $tasks = $this->pdo->prepare('
                    SELECT task_data_user.first_name, task_data_user.last_name, task_data_user.email,
                    tasks.id, tasks.description, tasks.image
                    FROM tasks
                    JOIN task_data_user
                    WHERE tasks.user_data_id = task_data_user.id
                    LIMIT :limit
                    OFFSET :offset
                    ');
        $tasks->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $tasks->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $tasks->execute();

        if ($tasks->rowCount() > 0) {

            return [
                'data' => $tasks->fetchAll(\PDO::FETCH_ASSOC),
                'pages' => $pages,
            ];

        } else {
            return [
                'data' => [],
                'pages' => 0
            ];
        }
    }
}