<?php 
    include('./config/db_connect.php');

    $sql ='SELECT category_id, category_name, category_icon FROM category ORDER BY category_id';

    $result = mysqli_query($conn, $sql);

    $category = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<section class="category my-5 bg-dark">
    <div class="container mb-5">
        <div class="row py-4">
            <div class="col-12">
                <h2 class="category_title text-light fw-bold">Top Categories</h2>
            </div>
        </div>
        <?php if($category): ?>
            <div class="row text-center d-flex flex-wrap">
                <?php foreach($category as $categories): ?>
                    <div class="col-3 mb-4">
                        <a class="text-dark" href="category?category_id=<?php echo htmlspecialchars($categories['category_id']); ?>&category_name=<?php echo htmlspecialchars($categories['category_name']); ?>">
                        <?php //echo htmlspecialchars($categories['category_name']); ?>
                            <div class="card">
                                <div class="card-body category-focus">
                                    <i class="<?php echo htmlspecialchars($categories['category_icon']); ?>"></i>
                                    <h5 class="card-title"><?php echo htmlspecialchars($categories['category_name']); ?></h5>                    
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h1>No Categories available!</h1>
        <?php endif; ?>
    </div>
</section>