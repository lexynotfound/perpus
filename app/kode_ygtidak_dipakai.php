<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Role</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        <select name="role" class="form-select <?php if (isset($errors['role'])) echo 'is-invalid'; ?>" required>
            <option value="petugas" <?= ($user->name == 'petugas') ? 'selected' : ''; ?>>petugas</option>
            <option value="anggota" <?= ($user->name == 'anggota') ? 'selected' : ''; ?>>anggota</option>
        </select>
        <?php if (isset($errors['role'])) : ?>
            <div class="invalid-feedback">
                <?= $errors['role']; ?>
            </div>
        <?php endif; ?>
    </div>
</div>