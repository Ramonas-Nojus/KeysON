<?php

class Order extends Db{

    public function addOrder($customer_name, $email, $address, $components, $date, $price, $order_number, $component_images){
        
        $sql = "INSERT INTO orders (customer_name, email, address, components, date, price, order_number, status, component_images) VALUES (:customer_name, :email, :address, :components, :date, :price, :order_number, 'Užsakytas', :component_images)";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':customer_name', $customer_name, PDO::PARAM_STR);
        $sth->bindValue(':email', $email, PDO::PARAM_STR);
        $sth->bindValue(':address', $address, PDO::PARAM_STR);
        $sth->bindValue(':components', $components, PDO::PARAM_STR);
        $sth->bindValue(':date', $date, PDO::PARAM_STR);
        $sth->bindValue(':price', $price, PDO::PARAM_STR);
        $sth->bindValue(':order_number', $order_number, PDO::PARAM_STR);
        $sth->bindValue(':component_images', $component_images, PDO::PARAM_STR);
        $sth->execute();
    }

    public function getOrder($order_number){
        $sql = "SELECT * FROM orders WHERE order_number = :order_number";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':order_number', $order_number, PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllOrders(){
        $sql = "SELECT * FROM orders WHERE status = 'Užsakytas' AND worker = 0";
        $sth = $this->connection()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function assignWorker($worker_id, $order_id) {
        $sql = "UPDATE orders SET worker = :worker_id WHERE id = :order_id";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':worker_id', $worker_id, PDO::PARAM_INT);
        $sth->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $sth->execute();
    }

    public function getAssignedOrders($worker_id){
        $sql = "SELECT * FROM orders WHERE worker = :worker_id AND status != 'Užsakytas' ";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':worker_id', $worker_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNotProcessedOrders($worker_id){
        $sql = "SELECT * FROM orders WHERE worker = :worker_id AND status = 'Užsakytas' ";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':worker_id', $worker_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($status, $order_id){
        $sql = "UPDATE orders SET status = :status WHERE id = :order_id ";
        $sth = $this->connection()->prepare($sql);
        $sth->bindValue(':status', $status, PDO::PARAM_STR);
        $sth->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $sth->execute();
    }

    public function getGraphData(){
        $sql = "SELECT DATE(date) AS order_date, SUM(price) AS total_price, COUNT(order_number) AS order_count FROM orders GROUP BY DATE(date)";
        $sth = $this->connection()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function getStatusData(){
        $sql = "SELECT 
                    SUM(CASE WHEN status = 'Pristatytas' THEN 1 ELSE 0 END) AS order_complete,
                    SUM(CASE WHEN status != 'Pristatytas' THEN 1 ELSE 0 END) AS order_incomplete
                FROM orders";
        $sth = $this->connection()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);

    }
}  