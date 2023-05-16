<?php
    include_once("../../config/database.php");

    session_start();

    if($_SESSION['username'] == ""){
      header('location:../index.php');
    }

    if(isset($_POST['submit'])){
      $kat_name = $_POST['kategori'];

      if(empty($kat_name)){
        echo "<script> alert('Nama Kategori Tidak Boleh Kosong')</script>";
      }
      else{
        $insert = $pdo->prepare("INSERT INTO tb_category (nm_cat) value(:cat)");
        $insert->bindParam(':cat',$kat_name);

        if($insert->execute()){
          echo "<script> alert('Data Berhasil Ditambahkan')</script>";
        }
        else{
          echo "<script> alert('Data Tidak Berhasil Ditambahkan')</script>";
        }
      }
    }
    
    include_once("../inc/header.php");

?>

<?php
    include_once("../inc/admin_sidebar.php");
?>

<div class="content-wrapper">
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Seluruh Kategori</h3>
              </div>
              
              <div class="card-body">Menampilkan
                <input type="number" style="width: 60px">Data/Halaman

                <div class="float-right">Pencarian:
                <input type="text" class="float-right">
                </div>

                <table id="example2" class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM tb_category";
                    $stmt = $pdo->query($sql);
                    while($row = $stmt->fetch()){
                      $id = $row["id"];
                      $cat = $row["nm_cat"];
                    ?>
                    <tr>
                      <td>
                        <?= $no++ ?>
                      </td>
                      <td>
                        <?= $cat ?>
                      </td>
                      <td>
                        <a href="update.php?id=<?= $id; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                      </td>    
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

                <div class="card-body pl-3 pr-3 pb-1">Menampilkan 1 Dari 1 Halaman
                  <div class="row float-right">
                    <button type="#" class="page-link text-dark" >Previous</button>
                    <button type="#" class="bg-primary page-link text-dark">1</button>
                    <button type="#" class="page-link text-dark">Next</button>
                  </div>
                </div>
              </div>

              
            </div>
            
          </div>
          
          <div class="col">

            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Kategori</h3>
              </div>
              
              <form method="Post" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="katInput">Nama Kategori</label>
                    <input type="text" class="form-control" id="katInput" name="kategori">
                  </div>
                

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
        </div>
        
      </div>

    </section>
  </div>

<?php
    include_once("../inc/footer.php");
?>
