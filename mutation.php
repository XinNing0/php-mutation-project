<?php
// File path to the allele data
$filename = __DIR__ . '/data/phenotypic_alleles.csv';

// Check if the file exists
if (!file_exists($filename)) {
    die("Error: Data file not found.");
}

// Open the file
$handle = fopen($filename, 'r');
if (!$handle) {
    die("Error: Unable to open file.");
}

echo "<h1>Gene Mutation Table (from MGI)</h1>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>MGI Allele Accession ID</th>
        <th>Allele Symbol</th>
        <th>Allele Name</th>
        <th>Mutation Type</th>
        <th>Gene Symbol</th>
        <th>Reference</th>
      </tr>";

// Skip comment lines (lines starting with #)
while (($line = fgets($handle)) !== false) {
    if (str_starts_with($line, "#")) continue;
    $fields = explode("\t", trim($line));

    // Adjust these indexes based on the actual column order
    $mgi_id = $fields[0] ?? '';
    $allele_symbol = $fields[1] ?? '';
    $allele_name = $fields[2] ?? '';
    $mutation_type = $fields[3] ?? '';
    $gene_symbol = end($fields); // often gene symbol is last

    echo "<tr>
            <td>$mgi_id</td>
            <td>$allele_symbol</td>
            <td>$allele_name</td>
            <td>$mutation_type</td>
            <td>$gene_symbol</td>
            <td><a href='https://www.informatics.jax.org/allele/$mgi_id' target='_blank'>View</a></td>
          </tr>";
}

fclose($handle);
echo "</table>";
?>
