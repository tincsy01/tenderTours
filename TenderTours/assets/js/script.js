
$(document).ready(function(){
    // Live Search
    $(".statisticTable").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".statisticTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Sort by category
    $(".category").on("change", function() {
        var value = $(this).val().toLowerCase();
        $(".statisticTable tr").filter(function() {
            if (value == "") {
                $(this).toggle(true);
            } else {
                return $(this).children("td:nth-child(2)").text().toLowerCase().indexOf(value) > -1;
            }
        }).toggle();
    });
});
// <form action="" method="post" id="search-form">
//     <?php
//     $sql = "SELECT a.attraction_id, a.name, a.longitude, a.lattitude, a.num_of_visitors, a.popular, c.category
//                     FROM attractions a INNER JOIN categories c ON c.category_id = a.category_id  WHERE a.org_id = :org_id";
//     $org_id = $_SESSION['user_id'];
//     $query = $pdo->prepare($sql);
//     $query->bindParam(':org_id', $org_id);
//     $query->execute();
//     $attractions = $query->fetchAll();
//     '<p>Live Search:</p>
//              <input class="form-control" id="myInput" type="text" placeholder="Search..">
//              <p>Select category</p>
//              <select name="type" class="form-control" id="type_dropdown">
//                       <option>---Select---</option>';
//     $sql = "SELECT category_id, category FROM categories";
//     $query = $pdo->prepare($sql);
//     $query->execute();
//     $categories = $query->fetchAll();
//     foreach ($categories as $category){
//         '<option value="'.$category['category_id'].'">'.$category['category'].'</option>';
//     }
//     '</select>';
//
//     $table = ' <table class="table" id="statisticTable">
//                 <thead>
//                 <tr>
//                 <!--  <th scope="col">#</th> -->
//                     <th scope="col">Name of attraction</th>
//                     <th scope="col">Number of visitors</th>
//                     <th scope="col">Popularity</th>
//                     <th scope="col">Type</th>
//
//                 </tr>
//                 </thead>
//                 <tbody>';
//     foreach ($attractions as $attraction) {
//         $table .= '<tr scope="row">
//                                     <td>' . $attraction['name'] . '</td>
//                                     <td>' . $attraction['num_of_visitors'] . '</td>
//                                     <td>' . $attraction['popular'] . '</td>
//                                     <td>' . $attraction['category'] . '</td>
//                                 </tr>';
//     }
//     $table .= '
//                         </tbody>
//                         </table>';
//     echo $table;
//     ?>
// </form>