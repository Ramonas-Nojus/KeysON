<?php 
session_start();


class Admin extends Db{

    public function logIn($email, $first_name, $last_name, $password, $id) {
        $sql = "SELECT password FROM admins WHERE email = :email AND first_name = :first_name AND last_name = :last_name AND id = :id";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':email', $email, PDO::PARAM_STR);
        $sth->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $sth->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->fetch();

        if ($row['password'] && password_verify($password, $row['password'])) {


            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['id'] = $id;

            header('Location: /admin/index.php');
            exit();
        } else {
            echo 'Invalid Log In data';
        }

    }


    public function logOut(){
        $_SESSION['email'] = null;
        $_SESSION['first_name'] = null;
        $_SESSION['last_name'] = null;
        $_SESSION['id'] = null;
    
        header('Location: /admin/index.php');
        exit();

    }

}