<footer>
    <div> Exercice par &nbsp;<?= $pageData['author'] ?> &copy;</div>
    <div><?php echo COMPANY_STREET_ADDRESS . ' ' . COMPANY_PROVINCE . ' ' . COMPANY_COUNTRY . ' ' . COMPANY_POSTAL_CODE . '</div><div>' . COMPANY_PHONE_NUMBER . '  <a href="mailto:name@rapidtables.com">' . COMPANY_EMAIL . '</a>

 </div>' ?><div>
            <p> <?php
                $pageData['compteVues'] =  viewCount(VISITOR_LOG_FILE);

                echo $pageData['compteVues'] . " Visiteur(s)";

                ?> </p>
        </div>
</footer>
</div>
</body>

</html>