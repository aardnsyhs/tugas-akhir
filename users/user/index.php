<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data User
        </h3>
    </div>
    <div class="card-body">
        <div>
            <?php
            $username = $_SESSION['username'];
            $sql = $koneksi->query("SELECT * FROM user WHERE username = '$username'");
            while ($data = $sql->fetch_assoc()) {
            ?>
                <div class="text-center">
                    <h3>Selamat Datang, <?= $data['nama_user'] ?></h3>
                </div>
                <a class="btn btn-primary" href="?page=edit_user&id_user=<?= $data['id_user'] ?>">Ubah Password</a>
            <?php } ?>
            </tbody>
            </tfoot>
            </table>
        </div>
    </div>