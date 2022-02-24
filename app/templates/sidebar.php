<div id="adminSidebar" class="list-group adminSidebar">
    <span href="#" class="list-group-item active">
        Admin
    </span>
    <a href="<?= $langPath ?>/" class="list-group-item">
        <i class="fa fa-plus"></i> <?= _("New htaccess") ?>
    </a>
    <a href="<?= $langPath ?>/my-htaccesses/" class="list-group-item">
        <i class="fa fa-folder-open-o"></i> <?= _("My htaccess's") ?>
    </a>
</div>
<? if(strpos($fullPath, 'new-htaccess' )){ ?>
<div id="htaccessSidebar" class="list-group htaccessSidebar">
    <span href="#" class="list-group-item active">
        <?= _("Current htaccess") ?>
    </span>
    <a href="#" class="list-group-item" data-toggle="modal" data-target="#yourHtaccessModal">
        <i class="fa fa-eye"></i> <?= _("View result") ?>
    </a>
    <a href="#" class="saveHtaccess list-group-item"> 
        <i class="fa fa-save"></i> <?= _("Save") ?>
    </a>
    <a href="#" class="downloadHtaccess list-group-item">
        <i class="fa fa-download"></i> <?= _("Download") ?>
    </a>
    <a class="copyHtaccess list-group-item" data-clipboard-target="yourHtaccessModalBody">
        <i class="fa fa-copy"></i> <?= _("Copy") ?>
    </a>
    <a href="#" class="resetHtaccessForm list-group-item">
        <i class="fa fa-refresh"></i> <?= _("Reset") ?>
    </a>
</div>
<? } ?>
<div id="serverInformation" class="list-group serverInformation">
    <span href="#" class="list-group-item active">
        <?= _("Server Information") ?>
    </span>
    <div href="#" class="list-group-item">
        <i class="fa fa-server"></i> <?= _("Software:") ?> <br/><?= $_SERVER['SERVER_SOFTWARE'] ?>
    </div>
    <div href="#" class="list-group-item">
        <i class="fa fa-info"></i> <?= _("Servername:") ?> <br/><?= $_SERVER['SERVER_NAME'] ?>
    </div>
    <div href="#" class="list-group-item">
        <i class="fa fa-home"></i> <?= _("Home:") ?> <br/><?= $_SERVER['HOME'] ?>
    </div>
</div>