<?php 

class Products extends Db{

    public function addProduct($name, $category, $image, $supplier_url, $stock, $price, $description) {

        if ($image['error'] === UPLOAD_ERR_OK) {
            $imageTmp = $image['tmp_name'];
            $imageName = basename($image['name']);
            $uploadDir = '../img/products/';
            $imagePath = $uploadDir . $imageName;

            if (!move_uploaded_file($imageTmp, $imagePath)) {
                echo "Failed to move uploaded file.";
                $imageName = null;
            }
        } else {
            $imageName = null;
        }

        $sql = "INSERT INTO products (name, price, image, description, category, stock, supplier_url) VALUES (:name, :price, :image, :description, :category, :stock, :supplier_url)";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":image", $imageName);
        $stmt->bindParam(":supplier_url", $supplier_url);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);

        if($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error adding product.";
        }
    }

    public function getFilteredProducts($search = null, $category = null, $from = 0, $to = 99999) {
        $sql = "SELECT * FROM products WHERE price BETWEEN :from AND :to";
        
        if ($category && $category !== 'all') {
            $sql .= " AND category = :category";
        }
        
        if ($search) {
            $sql .= " AND name LIKE :search";
        }
        
        $sql .= " ORDER BY id";

        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(":from", $from);
        $stmt->bindParam(":to", $to);

        if ($category && $category !== 'all') {
            $stmt->bindParam(":category", $category);
        }

        if ($search) {
            $searchParam = "%$search%";
            $stmt->bindParam(":search", $searchParam);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";

        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRelated($productId, $category, $limit = 8) {
        $sql = "SELECT * FROM products WHERE category = :cat AND id != :id ORDER BY RAND() LIMIT :limit";

        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(':cat', $category, PDO::PARAM_INT);
        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $related = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Step 2: Fill with randoms if not enough
        if (count($related) < $limit) {
            $needed = $limit - count($related);

            $sql = "SELECT * FROM products WHERE id != :id AND category != :cat ORDER BY RAND() LIMIT :limit";
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
            $stmt->bindValue(':cat', $category, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $needed, PDO::PARAM_INT);
            $stmt->execute();
            $fill = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $related = array_merge($related, $fill);
        }

        return $related;
    }


}