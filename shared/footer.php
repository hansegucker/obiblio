<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

# Be sure we don't get leftovers.
unset($_SESSION['pageErrors']);
unset($_SESSION['postVars']);
?>
</main>
<!-- **************************************************************************************
     * Footer
     **************************************************************************************-->
<footer class="page-footer">
    <div class="container">
        <ul>
            <?php if (OBIB_LIBRARY_URL != "") { ?>
                <li>
                    <a href="<?php echo H(OBIB_LIBRARY_URL); ?>" class="grey-text text-lighten-3">
                        <?php echo $headerLoc->getText("footerLibraryHome"); ?>
                    </a>
                </li>
            <?php }
            if (OBIB_OPAC_URL != "") { ?>
                <li>
                    <a href="<?php echo H(OBIB_OPAC_URL); ?>" class="grey-text text-lighten-3">
                        <?php echo $headerLoc->getText("footerOPAC"); ?>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=" . H(addslashes(U($helpPage))); ?>')"
                   class="grey-text text-lighten-3">
                    <?php echo $headerLoc->getText("footerHelp"); ?>
                </a>
            </li>
        </ul>
    </div>

    <br><br>
    <div class="footer-copyright">
        <div class="container">
            <?php echo $headerLoc->getText("footerPoweredBy"); ?> <?php echo H(OBIB_CODE_VERSION); ?>
            <?php echo $headerLoc->getText("footerDatabaseVersion"); ?> <?php echo H(OBIB_DB_VERSION); ?><br>
            <?php echo $headerLoc->getText("footerCopyright"); ?> &copy; 2002-2017 Dave Stevens, et al.
            <?php echo $headerLoc->getText("footerUnderThe"); ?>
            <a href="../home/license.php" class="grey-text text-lighten-4">
                <?php echo $headerLoc->getText("footerGPL"); ?>
            </a>
        </div>
    </div>

</footer>

</body>
</html>
