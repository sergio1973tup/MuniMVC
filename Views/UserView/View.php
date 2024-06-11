
<body>
    <table>
        <tbody>
            <?php
                foreach($Users as $row){
                    echo $row->getId().' '. $row->getName().' ' .$row->getLastName().' ' .$row->getEmail().'<br>';
                }
            ?>
        </tbody>
    </table>
</body>
