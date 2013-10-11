<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** PHPExcel */
require_once 'excel_pdf/PHPExcel.php';

/** PHPExcel_IOFactory */
require_once 'excel_pdf/PHPExcel/IOFactory.php';

/**
* Export and import excel and pdf Library
* @package Libraries
* @category Export and import
* @author Yanoski Camacho Román
*/
class Excel_pdf_manager
{
	
    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        //$this->CI = & get_instance();
        //$this->CI->config->load('auth_acl_config');
    }
    
   /**
    * Return the pase path for upload in server
    *
    * @access public
    * @param  
    * @return string, path
    */
    function server_base_path()
    {
        return 'D:/TRABAJO/Proyectos/SchoolPEI/Admin/SchoolPEI.admin/';
    }
    
    /**
     * Create data validations
     *
     * @access private
     * @param  PHPExcel, an PHPExcel object
     * @param  array, list of columns and rules
     * @param  int, rows to apply calidations
     * @return PHPExcel, an PHPExcel object
     */
    private function data_validations($objPHPExcel, $validations, $rows_quantity = 1000)
    {
        $rows_quantity++;  //porque empieza desde 2

        //creando hoja para poner los nomencladores
        $objPHPExcel->createSheet();           
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setTitle('nomencladores');
            
        foreach ($validations as $validation)     
        {
            $column = $validation[0];
            $values = $validation[1];
            $col = PHPExcel_Cell::columnIndexFromString($column)-1; 
            
            //escribiendo nomencladores de esta regla en la hoja 1
            $objPHPExcel->setActiveSheetIndex(1);
            $objWorksheet = $objPHPExcel->getActiveSheet();
    
            $row = 1;
            foreach ($values as $value)
            {
                $objWorksheet->setCellValueByColumnAndRow($col, $row, $value);
                $row++;
            }

            //rango de valores, incluyendo uno vacío en la fila 1
            $row--;
            $range = '=nomencladores!$'.$column.'$1:$'.$column.'$'.$row;   //ej: =nomencladores!$B$1:$B$4
           
            //validando la columna en la hoja 0
            $objPHPExcel->setActiveSheetIndex(0);
            for ($i=2; $i<$rows_quantity; $i++)
            {
                $cell = $column.$i;
                $objValidation = $objPHPExcel->getActiveSheet()->getCell($cell)->getDataValidation();
                $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                $objValidation->setAllowBlank(true);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Error de entrada');
                $objValidation->setError('El valor no está en la lista.');
                $objValidation->setPromptTitle('Seleccione de la lista');
                $objValidation->setPrompt('Por favor seleccione un valor de la lista.');
                $objValidation->setFormula1($range);	// Make sure to put the list items between " and "  !!!
                $objPHPExcel->getActiveSheet()->getCell($cell)->setDataValidation($objValidation);

            }
        } 
        $objPHPExcel->setActiveSheetIndex(0);
        return $objPHPExcel;
    }
    
    /**
     * Create an excel from a table
     *
     * @access private
     * @param  string, table name
     * @param  array, table
     * @return PHPExcel, an PHPExcel object
     */
    private function create_xls($tablename, $table, $validations = '')
    {
        //creando objetos y estableciendo propiedades
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("SchoolPei")
                                     ->setLastModifiedBy("SchoolPei")
                                     ->setTitle("SchoolPei Report")
                                     ->setSubject("SchoolPei Report")
                                     ->setDescription("SchoolPei Report")
                                     ->setKeywords("SchoolPei Report")
                                     ->setCategory("SchoolPei Report");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($tablename);     
       
        //llenando celdas
        $column = 0;
        $row = 1;
        foreach ($table as $record)
        {
            foreach ($record as $value)
            {
                //$objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $value);
                $column++;
            }
            $column = 0;
            $row++;
        }

        //reglas de validación
        if ( !empty($validations) )
            $this->data_validations($objPHPExcel, $validations, $row+9); //se lo aplico a 10 filas más
        
        //encabezado en negritas
        $styleArray = array(
                'font' => array(
                        'bold' => true,
                ));
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($styleArray);
        
        for ($i = 'A'; $i<= 'N'; $i++)
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);

        
        return $objPHPExcel;
    }

    /**
     * Import excel
     *
     * @access public
     * @param  string, filename including path
     * @param  int, active sheet 0 by default
     * @return array, table
     */
    function import($filename, $activeSheet = '0')
    {
        $ext = explode('.', $filename);
        $ext = end($ext);
        
        if ($ext == 'xlsx')
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        else
        if ($ext == 'xls')
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
        else
            return NULL;
        
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $table = array();
        foreach ($objWorksheet->getRowIterator() as $row) 
        {
            $record = array();
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);  // This loops all cells,
                                                                // even if it is not set.
                                                                // By default, only cells
                                                                // that are set will be
                                                                // iterated.
            foreach ($cellIterator as $cell)
            {
                $record[] = $cell->getValue();
            }
            
            $table[] = $record;
        }
        
        return $table;
    }
    
    /**
     * Export table
     *
     * @access public
     * @param  string, table name
     * @param  array, table
     * @param  string, file name including the path
     * @return bool, operation result
     */
    function export($tablename, $table, $format = 'xlsx', $validations = '', $path = '')
    {
        $objPHPExcel = $this->create_xls($tablename, $table, $validations);
        
        if ($format == 'xlsx')
        {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $ext = '.xlsx';
        }
        else
        if ($format == 'xls')
        {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $ext = '.xls';
        }
        else
        if ($format == 'pdf')
        {
            $objPHPExcel->getActiveSheet()->setShowGridLines(true);
            $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
            //$objWriter->setSheetIndex(0);
            $ext = '.pdf';
        }
        else
            return NULL;
        
        if ($path)
        {
            $filename = $path.$tablename.$ext;
            $objWriter->save($filename);
        }
        else
        {
            // Redirect output to a client web browser
            
            if ($format == 'xlsx')
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            else
            if ($format == 'xls')
                header('Content-Type: application/vnd.ms-excel');
            else
            if ($format == 'pdf')
                header('Content-Type: application/x-forcedownload');
            else
                return NULL;
            
            header('Content-Disposition: attachment;filename="'.$tablename.$ext);
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
        
    }

    
}

?>