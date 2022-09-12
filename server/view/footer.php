<footer>
    Exercice par<?= $pageData['author'] ?> &copy;
    <p><?php echo COMPANY_STREET_ADDRESS . ' ' . COMPANY_PROVINCE . ' ' . COMPANY_COUNTRY . ' ' . COMPANY_POSTAL_CODE . '</p><p>' . COMPANY_PHONE_NUMBER . '  <a href="mailto:name@rapidtables.com">' . COMPANY_EMAIL . '</a>

 </p>' ?></p>
    <p> <?php
        $pageData['compteVues'] =  viewCount(VISITOR_LOG_FILE);

        echo $pageData['compteVues'] . " Visiteur(s)";

        ?> </p>
</footer>
</div>
</body>

</html>