<?php foreach ($laporanbuku as $lp) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $lp->tgl_laporan; ?></td>
        <td><?= $lp->id_laporan_buku; ?></td>
        <td><?= $lp->judul_laporan; ?></td>
        <td><?= $lp->id_buku; ?></td>
        <td><?= $lp->title; ?></td>
        <td><?= $lp->jml; ?></td>
        <td><?= $lp->jenis_laporan; ?></td>
    </tr>
<?php endforeach; ?>