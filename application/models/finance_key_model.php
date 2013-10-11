<?php

/**
 * @Finance_key_model controller class
 * @package Model
 * @author Aylienn Aquino Leiva
 */
class Finance_key_model extends CI_Model {

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountAllFinanceKey() {
        $sql = "SELECT * FROM tb_financing_key";
        return count($this->db->get('tb_financing_key')->result());
    }

    public function getAllgetFinanceKey($inicio=-1, $limite=-1, $elementoOrdenar='', $dirOrdenar='asc') {
        $this->db->select('public.tb_financing_key.fk_seg_program,
                           public.tb_n_cicle.description AS description_cicle,
                           public.tb_n_cicle.id_cicle,
                           public.tb_n_activity.id_activity,
                           public.tb_n_activity.description AS description_activity,
                           public.tb_n_financing_program.id_financing_program,
                           public.tb_n_financing_program.description AS description_financing_program,
                           public.tb_n_program.id_program,
                           public.tb_n_program.description AS description_program,
                           public.tb_n_rector_axis.id_rector_axis,
                           public.tb_n_rector_axis.description AS description_rector_axis,
                           public.tb_financing_key.id_financing_key');

        $this->db->join('public.tb_seg_program ', 'public.tb_financing_key.fk_seg_program=public.tb_seg_program.id_seg_program');
        $this->db->join('public.tb_n_rector_axis', 'public.tb_seg_program.fk_rector_axis=public.tb_n_rector_axis.id_rector_axis');
        $this->db->join('public.tb_n_program ', 'public.tb_seg_program.fk_program=public.tb_n_program.id_program');
        $this->db->join('public.tb_n_financing_program', 'public.tb_seg_program.fk_financing_program=public.tb_n_financing_program.id_financing_program');
        $this->db->join('public.tb_n_activity', 'public.tb_seg_program.fk_activity=public.tb_n_activity.id_activity');
        $this->db->join('public.tb_n_cicle', 'public.tb_financing_key.fk_seg_cicle=public.tb_n_cicle.id_cicle');

        $this->config->load('auth_acl_config');
        $user = $this->config->item('su_name');
        if($this->session->userdata('user') != $user)
        {
            $this->db->join('public.tb_seg_organization', 'public.tb_financing_key.fk_seg_organization=public.tb_seg_organization.id_seg_organization');
            $this->db->join('public.users', 'public.tb_seg_organization.fk_subsecretary=public.users.fk_subsecretary');
            $this->db->where('public.users."NICKNAME"', $this->session->userdata('user'));
        }

        if ($elementoOrdenar != null)
            $this->db->order_by('tb_financing_key.' . $elementoOrdenar, $dirOrdenar);
        if ($limite != null && $inicio != null)
            $this->db->limit($limite, $inicio);

        return $this->db->get('public.tb_financing_key')->result();
    }

    function getFinanceKeyById($id) {
        $sql = "SELECT
                  public.tb_seg_geographic.id_seg_geographic,
                  public.tb_seg_geographic.fk_region,
                  public.tb_seg_geographic.fk_municipality,
                  public.tb_seg_geographic.fk_locality,
                  public.tb_seg_cog.id_seg_cog,
                  public.tb_seg_cog.fk_charpe,
                  public.tb_seg_cog.fk_concept,
                  public.tb_seg_cog.fk_generic_departure,
                  public.tb_seg_cog.fk_specific_departure,
                  public.tb_seg_cri.fk_tag_cri,
                  public.tb_seg_cri.fk_type,
                  public.tb_seg_cri.fk_class,
                  public.tb_seg_cri.fk_concept_cri,
                  public.tb_seg_cri.id_seg_cri,
                  public.tb_seg_function.id_seg_function,
                  public.tb_seg_function.fk_purpose,
                  public.tb_seg_function.fk_function,
                  public.tb_seg_function.fk_subfunction,
                  public.tb_seg_organization.id_seg_organization,
                  public.tb_seg_organization.fk_part,
                  public.tb_seg_organization.fk_ambit,
                  public.tb_seg_organization.fk_power,
                  public.tb_seg_organization.fk_geografic_unit,
                  public.tb_seg_organization.fk_secretary,
                  public.tb_seg_organization.fk_subsecretary,
                  public.tb_seg_organization.fk_address,
                  public.tb_seg_organization.fk_departament,
                  public.tb_seg_account.id_seg_account,
                  public.tb_seg_account.fk_genre,
                  public.tb_seg_account.fk_group,
                  public.tb_seg_account.fk_tag_account,
                  public.tb_seg_account.fk_account,
                  public.tb_seg_account.fk_subaccount,
                  public.tb_seg_account.fk_specific,
                  public.tb_seg_program.id_seg_program,
                  public.tb_seg_program.fk_rector_axis,
                  public.tb_seg_program.fk_program,
                  public.tb_seg_program.fk_financing_program,
                  public.tb_seg_program.fk_financing_subprogram,
                  public.tb_seg_program.fk_activity,
                  public.tb_seg_source.id_seg_source,
                  public.tb_seg_source.fk_subsource,
                  public.tb_seg_source.fk_source,
                  public.tb_seg_source.fk_year,
                  public.tb_financing_key.fk_seg_cicle,
                  public.tb_financing_key.fk_seg_entity,
                  public.tb_financing_key.fk_seg_expend_type,
                  public.tb_financing_key.fk_seg_dependance,
                  public.tb_financing_key.id_financing_key,
                  public.tb_financing_key.fk_state_plan
                FROM
                 public.tb_financing_key
                 INNER JOIN public.tb_seg_cog ON (public.tb_financing_key.fk_seg_cog=public.tb_seg_cog.id_seg_cog)
                 INNER JOIN public.tb_seg_function ON (public.tb_financing_key.fk_seg_function=public.tb_seg_function.id_seg_function)
                 INNER JOIN public.tb_seg_geographic ON (public.tb_financing_key.fk_seg_geographic=public.tb_seg_geographic.id_seg_geographic)
                 INNER JOIN public.tb_seg_cri ON (public.tb_financing_key.fk_seg_cri=public.tb_seg_cri.id_seg_cri)
                 INNER JOIN public.tb_seg_account ON (public.tb_financing_key.fk_seg_account=public.tb_seg_account.id_seg_account)
                 INNER JOIN public.tb_seg_source ON (public.tb_financing_key.fk_seg_source=public.tb_seg_source.id_seg_source)
                 INNER JOIN public.tb_seg_organization ON (public.tb_financing_key.fk_seg_organization=public.tb_seg_organization.id_seg_organization)
                 INNER JOIN public.tb_seg_program ON (public.tb_financing_key.fk_seg_program=public.tb_seg_program.id_seg_program)

             WHERE  public.tb_financing_key.id_financing_key = $id";

        return $this->db->query($sql)->row();
    }

    function insertFinanceKey($data) {

        /*         * ******INSERT tb_seg_cri****** */
        $result_seg_cri = array(
            'fk_tag_cri' => $data['tag_cri'],
            'fk_type' => $data['type'],
            'fk_class' => $data['class'],
            'fk_concept_cri' => $data['concept_cri'],
        );
        $this->db->insert('tb_seg_cri', $result_seg_cri);
        $seg_cri = $this->db->insert_id();

        /*         * ******INSERT tb_seg_account****** */
        $result_seg_account = array(
            'fk_genre' => $data['genre'],
            'fk_group' => $data['group'],
            'fk_tag_account' => $data['tag_account'],
            'fk_account' => $data['account'],
            'fk_subaccount' => $data['subaccount'],
            'fk_specific' => $data['specific'],
        );
        $this->db->insert('tb_seg_account', $result_seg_account);
        $seg_account = $this->db->insert_id();
        
        /*         * ******INSERT tb_seg_cog****** */
        $result_seg_cog = array(
            'fk_charpe' => $data['chapter'],
            'fk_concept' => $data['concept'],
            'fk_generic_departure' => $data['generic_dep'],
            'fk_specific_departure' => $data['specific_dep'],
        );
        $this->db->insert('tb_seg_cog', $result_seg_cog);
        $seg_cog = $this->db->insert_id();

        /*         * ******INSERT tb_seg_source****** */
        $result_seg_source = array(
            'fk_source' => $data['source'],
            'fk_subsource' => $data['subsource'],
            'fk_year' => $data['year'],
        );
        $this->db->insert('tb_seg_source', $result_seg_source);
        $seg_source = $this->db->insert_id();

        /*         * ******INSERT tb_seg_organization****** */
        $result_seg_organization = array(
            'fk_part' => $data['part'],
            'fk_ambit' => $data['ambit'],
            'fk_power' => $data['power'],
            'fk_geografic_unit' => $data['geografic_unit'],
            'fk_secretary' => $data['secretary'],
            'fk_subsecretary' => $data['subsecretary'],
            'fk_address' => $data['address'],
            'fk_departament' => $data['departament'],
        );
        $this->db->insert('tb_seg_organization', $result_seg_organization);
        $seg_organization = $this->db->insert_id();

        /*         * ******INSERT tb_seg_function****** */
        $result_seg_function = array(
            'fk_purpose' => $data['purpose'],
            'fk_function' => $data['function'],
            'fk_subfunction' => $data['subfunction'],
        );
        $this->db->insert('tb_seg_function', $result_seg_function);
        $seg_function = $this->db->insert_id();
        
        /*         * ******INSERT tb_seg_program****** */
        $result_seg_program = array(
            'fk_rector_axis' => $data['rector_axis'],
            'fk_program' => $data['program'],
            'fk_financing_program' => $data['financing_program'],
            'fk_financing_subprogram' => $data['financing_subprogram'],
            'fk_activity' => $data['activity'],
        );
        $this->db->insert('tb_seg_program', $result_seg_program);
        $seg_program = $this->db->insert_id();

        /*         * ******INSERT tb_seg_geographic****** */
        $result_seg_geographic = array(
            'fk_region' => $data['region'],
            'fk_municipality' => $data['municipality'],
            'fk_locality' => $data['locality'],
        );
        $this->db->insert('tb_seg_geographic', $result_seg_geographic);
        $seg_geographic = $this->db->insert_id();

        /*         * ***********INSERT tb_financing_key******************* */
        $result_financing_key = array(
            'fk_seg_cicle' => $data['cicle'],
            'fk_seg_entity' => $data['entity'],
            'fk_seg_cog' => $seg_cog,
            'fk_seg_expend_type' => $data['expend_type'],
            'fk_seg_function' => $seg_function,
            'fk_seg_geographic' => $seg_geographic,
            'fk_seg_dependance' => $data['dependance'],
            'fk_seg_cri' => $seg_cri,
            'fk_seg_account' => $seg_account,
            'fk_seg_source' => $seg_source,
            'fk_seg_organization' => $seg_organization,
            'fk_seg_program' => $seg_program,
            'fk_state_plan' => $data['id_plan_state'],
        );
        $this->db->insert('tb_financing_key', $result_financing_key);
        return $this->db->insert_id();
    }

    function updateFinanceKey($data, $fk_seg_cri, $fk_seg_account, $fk_seg_cog, $fk_seg_source, $fk_seg_organization, $fk_seg_function, $fk_seg_program, $fk_seg_geographic) {

         /*         * ******EDIT tb_seg_cri****** */
        $result_seg_cri = array(
            'fk_tag_cri' => $data['tag_cri'],
            'fk_type' => $data['type'],
            'fk_class' => $data['class'],
            'fk_concept_cri' => $data['concept_cri'],
        );
        $this->db->update('tb_seg_cri', $result_seg_cri, array('id_seg_cri' => $fk_seg_cri));

        /*         * ******EDIT tb_seg_account****** */
        $result_seg_account = array(
            'fk_genre' => $data['genre'],
            'fk_group' => $data['group'],
            'fk_tag_account' => $data['tag_account'],
            'fk_account' => $data['account'],
            'fk_subaccount' => $data['subaccount'],
            'fk_specific' => $data['specific'],
        );
        $this->db->update('tb_seg_account', $result_seg_account, array('id_seg_account' => $fk_seg_account));

        /*         * ******EDIT tb_seg_cog****** */
        $result_seg_cog = array(
            'fk_charpe' => $data['chapter'],
            'fk_concept' => $data['concept'],
            'fk_generic_departure' => $data['generic_dep'],
            'fk_specific_departure' => $data['specific_dep'],
        );
        $this->db->update('tb_seg_cog', $result_seg_cog, array('id_seg_cog' => $fk_seg_cog));

        /*         * ******EDIT tb_seg_source****** */
        $result_seg_source = array(
            'fk_source' => $data['source'],
            'fk_subsource' => $data['subsource'],
            'fk_year' => $data['year'],
        );
        $this->db->update('tb_seg_source', $result_seg_source, array('id_seg_source' => $fk_seg_source));

        /*         * ******EDIT tb_seg_organization****** */
        $result_seg_organization = array(
            'fk_part' => $data['part'],
            'fk_ambit' => $data['ambit'],
            'fk_power' => $data['power'],
            'fk_geografic_unit' => $data['geografic_unit'],
            'fk_secretary' => $data['secretary'],
            'fk_subsecretary' => $data['subsecretary'],
            'fk_address' => $data['address'],
            'fk_departament' => $data['departament'],
        );
        $this->db->update('tb_seg_organization', $result_seg_organization, array('id_seg_organization' => $fk_seg_organization));

        /*         * ******EDIT tb_seg_function****** */
        $result_seg_function = array(
            'fk_purpose' => $data['purpose'],
            'fk_function' => $data['function'],
            'fk_subfunction' => $data['subfunction'],
        );
        $this->db->update('tb_seg_function', $result_seg_function, array('id_seg_function' => $fk_seg_function));

        /*         * ******EDIT tb_seg_program****** */
        $result_seg_program = array(
            'fk_rector_axis' => $data['rector_axis'],
            'fk_program' => $data['program'],
            'fk_financing_program' => $data['financing_program'],
            'fk_financing_subprogram' => $data['financing_subprogram'],
            'fk_activity' => $data['activity'],
        );
        $this->db->update('tb_seg_program', $result_seg_program, array('id_seg_program' => $fk_seg_program));

        /*         * ******EDIT tb_seg_geographic****** */
        $result_seg_geographic = array(
            'fk_region' => $data['region'],
            'fk_municipality' => $data['municipality'],
            'fk_locality' => $data['locality'],
        );
        $this->db->update('tb_seg_geographic', $result_seg_geographic, array('id_seg_geographic' => $fk_seg_geographic));

        /*         * ***********EDIT tb_financing_key******************* */
        $result_financing_key = array(
            'fk_seg_cicle' => $data['cicle'],
            'fk_seg_entity' => $data['entity'],
            'fk_seg_expend_type' => $data['expend_type'],
            'fk_seg_dependance' => $data['dependance'],
            'fk_state_plan' => $data['id_plan_state'],
        );
       return $this->db->update('tb_financing_key', $result_financing_key, array('id_financing_key' => $data['id_financing_key']));

       
    }

    function deleteFinanceKey($id) {
        $data = $this->db->select('tb_financing_key.*')->where('tb_financing_key.id_financing_key', $id)->get('tb_financing_key')->result();
        $fk_seg_cri = $data[0]->fk_seg_cri;
        $fk_seg_account = $data[0]->fk_seg_account;
        $fk_seg_cog = $data[0]->fk_seg_cog;
        $fk_seg_source = $data[0]->fk_seg_source;
        $fk_seg_organization = $data[0]->fk_seg_organization;
        $fk_seg_function = $data[0]->fk_seg_function;
        $fk_seg_program = $data[0]->fk_seg_program;
        $fk_seg_geographic = $data[0]->fk_seg_geographic;

        $this->db->delete('tb_financing_key', array('id_financing_key' => $id));
        $this->db->delete('tb_seg_cri', array('id_seg_cri' => $fk_seg_cri));
        $this->db->delete('tb_seg_account', array('id_seg_account' => $fk_seg_account));
        $this->db->delete('tb_seg_cog', array('id_seg_cog' => $fk_seg_cog));
        $this->db->delete('tb_seg_source', array('id_seg_source' => $fk_seg_source));
        $this->db->delete('tb_seg_organization', array('id_seg_organization' => $fk_seg_organization));
        $this->db->delete('tb_seg_function', array('id_seg_function' => $fk_seg_function));
        $this->db->delete('tb_seg_program', array('id_seg_program' => $fk_seg_program));
        $this->db->delete('tb_seg_geographic', array('id_seg_geographic' => $fk_seg_geographic));
        return true;
    }

    function loadCicle() {
        $sql = "SELECT * FROM tb_n_cicle";
        return $this->db->query($sql)->result();
    }
    
    function loadEntity() {
        $sql = "SELECT * FROM tb_n_entity";
        return $this->db->query($sql)->result();
    }

    function loadExpendType() {
        $sql = "SELECT * FROM tb_n_expend_type";
        return $this->db->query($sql)->result();
    }

    function loadDependance() {
        $sql = "SELECT * FROM tb_n_dependance";
        return $this->db->query($sql)->result();
    }

    function loadChapter() {
        $sql = "SELECT * FROM tb_n_chapter";
        return $this->db->query($sql)->result();
    }

    function loadPurpose() {
        $sql = "SELECT * FROM tb_n_purpose";
        return $this->db->query($sql)->result();
    }

    function loadRegion() {
        $sql = "SELECT * FROM tb_n_region";
        return $this->db->query($sql)->result();
    }

    function loadConcept() {
        $sql = "SELECT * FROM tb_n_concept";
        return $this->db->query($sql)->result();
    }

    function loadGenericDep() {
        $sql = "SELECT * FROM tb_n_generic_departure";
        return $this->db->query($sql)->result();
    }

    function loadSpecificDep() {
        $sql = "SELECT * FROM tb_n_specific_departure";
        return $this->db->query($sql)->result();
    }

    function loadFunction() {
        $sql = "SELECT * FROM tb_n_function";
        return $this->db->query($sql)->result();
    }

    function loadSubFunction() {
        $sql = "SELECT * FROM tb_n_subfunction";
        return $this->db->query($sql)->result();
    }

    function loadMunicipality() {
        $sql = "SELECT * FROM tb_n_municipality";
        return $this->db->query($sql)->result();
    }
    
    function loadLocality() {
        $sql = "SELECT * FROM tb_n_locality";
        return $this->db->query($sql)->result();
    }

    function loadTagCri() {
        $sql = "SELECT * FROM tb_n_tag_cri";
        return $this->db->query($sql)->result();
    }

    function loadType() {
        $sql = "SELECT * FROM tb_n_type";
        return $this->db->query($sql)->result();
    }

    function loadClass() {
        $sql = "SELECT * FROM tb_n_class";
        return $this->db->query($sql)->result();
    }

    function loadConceptCri() {
        $sql = "SELECT * FROM tb_n_concept_cri";
        return $this->db->query($sql)->result();
    }

    function loadGenre() {
        $sql = "SELECT * FROM tb_n_genre";
        return $this->db->query($sql)->result();
    }

    function loadGroup() {
        $sql = "SELECT * FROM tb_n_group";
        return $this->db->query($sql)->result();
    }

    function loadTagAccount() {
        $sql = "SELECT * FROM tb_n_tag_account";
        return $this->db->query($sql)->result();
    }

    function loadAccount() {
        $sql = "SELECT * FROM tb_n_account";
        return $this->db->query($sql)->result();
    }

    function loadSubAccount() {
        $sql = "SELECT * FROM tb_n_subaccount";
        return $this->db->query($sql)->result();
    }

    function loadSpecific() {
        $sql = "SELECT * FROM tb_n_specific";
        return $this->db->query($sql)->result();
    }

    function loadSource() {
        $sql = "SELECT * FROM tb_n_source";
        return $this->db->query($sql)->result();
    }

    function loadSubSource() {
        $sql = "SELECT * FROM tb_n_subsource";
        return $this->db->query($sql)->result();
    }

    function loadYear() {
        $sql = "SELECT * FROM tb_n_year";
        return $this->db->query($sql)->result();
    }

    function loadPart() {
        $sql = "SELECT * FROM tb_n_part";
        return $this->db->query($sql)->result();
    }

    function loadAmbit() {
        $sql = "SELECT * FROM tb_n_ambit";
        return $this->db->query($sql)->result();
    }

    function loadPower() {
        $sql = "SELECT * FROM tb_n_power";
        return $this->db->query($sql)->result();
    }

    function loadGeograficUnit() {
        $sql = "SELECT * FROM tb_n_geografic_unit";
        return $this->db->query($sql)->result();
    }

    function loadSecretary() {
        $sql = "SELECT * FROM tb_n_secretary";
        return $this->db->query($sql)->result();
    }

    function loadSubSecretary() {
        $sql = "SELECT * FROM tb_n_subsecretary";
        return $this->db->query($sql)->result();
    }

    function loadAddress() {
        $sql = "SELECT * FROM tb_n_address";
        return $this->db->query($sql)->result();
    }

    function loadDepartament() {
        $sql = "SELECT * FROM tb_n_departament";
        return $this->db->query($sql)->result();
    }

    function loadProgram() {
        $sql = "SELECT * FROM tb_n_program";
        return $this->db->query($sql)->result();
    }

    function loadFinancingProgram() {
        $sql = "SELECT * FROM tb_n_financing_program";
        return $this->db->query($sql)->result();
    }

    function loadFinancingSubProgram() {
        $sql = "SELECT * FROM tb_n_financing_subprogram";
        return $this->db->query($sql)->result();
    }

    function loadActivity() {
        $sql = "SELECT * FROM tb_n_activity";
        return $this->db->query($sql)->result();
    }

    function loadAjaxConceptByIdChapter($id){
        $this->db->select('*');
        $this->db->where('tb_n_concept.fk_chapter', $id);
        return $this->db->get('tb_n_concept')->result();
    }
    
    function loadAjaxGenericDepByConcept($id){
        $this->db->select('*');
        $this->db->where('tb_n_generic_departure.fk_concept', $id);
        return $this->db->get('tb_n_generic_departure')->result();
    }

    function loadAjaxSpecificDepByGenericDep($id){
        $this->db->select('*');
        $this->db->where('tb_n_specific_departure.fk_generic_departure', $id);
        return $this->db->get('tb_n_specific_departure')->result();
    }

    function loadAjaxFunctionByPurpose($id){
        $this->db->select('*');
        $this->db->where('tb_n_function.fk_purpose', $id);
        return $this->db->get('tb_n_function')->result();
    }

    function loadAjaxSubfunctionByFunction($id){
        $this->db->select('*');
        $this->db->where('tb_n_subfunction.fk_function', $id);
        return $this->db->get('tb_n_subfunction')->result();
    }

    function loadAjaxMunicipalityByRegion($id){
        $this->db->select('*');
        $this->db->where('tb_n_municipality.fk_region', $id);
        return $this->db->get('tb_n_municipality')->result();
    }
    
    function loadAjaxLocalityByMunicipality($id){
        $this->db->select('*');
        $this->db->where('tb_n_locality.fk_municipality', $id);
        return $this->db->get('tb_n_locality')->result();
    }

    function loadAjaxTypeByTagCri($id){
        $this->db->select('*');
        $this->db->where('tb_n_type.fk_tag_cri', $id);
        return $this->db->get('tb_n_type')->result();
    }

    function loadAjaxClassByType($id){
        $this->db->select('*');
        $this->db->where('tb_n_class.fk_type', $id);
        return $this->db->get('tb_n_class')->result();
    }

    function loadAjaxConceptCriByClass($id){
        $this->db->select('*');
        $this->db->where('tb_n_concept_cri.fk_class', $id);
        return $this->db->get('tb_n_concept_cri')->result();
    }

    function loadAjaxGroupByGenre($id){
        $this->db->select('*');
        $this->db->where('tb_n_group.fk_genre', $id);
        return $this->db->get('tb_n_group')->result();
    }
    
    function loadAjaxTagAccountByGroup($id){
        $this->db->select('*');
        $this->db->where('tb_n_tag_account.fk_group', $id);
        return $this->db->get('tb_n_tag_account')->result();
    }

    function loadAjaxAccountByTagAccount($id){
        $this->db->select('*');
        $this->db->where('tb_n_account.fk_tag_account', $id);
        return $this->db->get('tb_n_account')->result();
    }
    
    function loadAjaxSubAccountByAccount($id){
        $this->db->select('*');
        $this->db->where('tb_n_subaccount.fk_account', $id);
        return $this->db->get('tb_n_subaccount')->result();
    }

    function loadAjaxSpecificBySubAccount($id){
        $this->db->select('*');
        $this->db->where('tb_n_specific.fk_subaccount', $id);
        return $this->db->get('tb_n_specific')->result();
    }

    function loadAjaxSubSourceBySource($id){
        $this->db->select('*');
        $this->db->where('tb_n_subsource.fk_source', $id);
        return $this->db->get('tb_n_subsource')->result();
    }

    function loadAjaxYearBySubSource($id){
        $this->db->select('*');
        $this->db->where('tb_n_year.fk_subsource', $id);
        return $this->db->get('tb_n_year')->result();
    }

    function loadAjaxAmbitByPart($id){
        $this->db->select('*');
        $this->db->where('tb_n_ambit.fk_part', $id);
        return $this->db->get('tb_n_ambit')->result();
    }

    function loadAjaxPowerByAmbit($id){
        $this->db->select('*');
        $this->db->where('tb_n_power.fk_ambit', $id);
        return $this->db->get('tb_n_power')->result();
    }

    function loadAjaxGeograficUnitByPower($id){
        $this->db->select('*');
        $this->db->where('tb_n_geografic_unit.fk_power', $id);
        return $this->db->get('tb_n_geografic_unit')->result();
    }

    function loadAjaxSecretaryByGeograficUnit($id){
        $this->db->select('*');
        $this->db->where('tb_n_secretary.fk_geografic_unit', $id);
        return $this->db->get('tb_n_secretary')->result();
    }

    function loadAjaxSubSecretaryBySecretary($id){
        $this->db->select('*');
        $this->db->where('tb_n_subsecretary.fk_secretary', $id);
        return $this->db->get('tb_n_subsecretary')->result();
    }

    function loadAjaxAddressBySubSecretary($id){
        $this->db->select('*');
        $this->db->where('tb_n_address.fk_subsecretary', $id);
        return $this->db->get('tb_n_address')->result();
    }

    function loadAjaxDepartamentByAddress($id){
        $this->db->select('*');
        $this->db->where('tb_n_departament.fk_address', $id);
        return $this->db->get('tb_n_departament')->result();
    }

    function loadAjaxProgramByRectorAxis($id){
        $this->db->select('*');
        $this->db->where('tb_n_program.fk_rector_axis', $id);
        return $this->db->get('tb_n_program')->result();
    }

    function loadAjaxFinancingProgramByProgram($id){
        $this->db->select('*');
        $this->db->where('tb_n_financing_program.fk_programPED', $id);
        return $this->db->get('tb_n_financing_program')->result();
    }

    function loadAjaxFinancingSubProgramByFinancingProgram($id){
        $this->db->select('*');
        $this->db->where('tb_n_financing_subprogram.fk_financing_program', $id);
        return $this->db->get('tb_n_financing_subprogram')->result();
    }

    function loadAjaxActivityByFinancingSubProgram($id){
        $this->db->select('*');
        $this->db->where('tb_n_activity.fk_financing_subprogram', $id);
        return $this->db->get('tb_n_activity')->result();
    }

    function verifierUserAsociateSubsecreatry($user){
        
        $this->db->select('*');
        $this->db->where('public.users."NICKNAME"',$user);
        return $this->db->get('public.users')->row();
    }

    function loadAjaxPartAsociateIdSubSecretary($id_subsecreatry){
        $this->db->select('public.tb_n_part.id_part,
                           public.tb_n_part.description');

        $this->db->join('public.tb_n_ambit', 'public.tb_n_part.id_part=public.tb_n_ambit.fk_part');
        $this->db->join('public.tb_n_power', 'public.tb_n_ambit.id_ambit=public.tb_n_power.fk_ambit');
        $this->db->join('public.tb_n_geografic_unit', 'public.tb_n_power.id_power=public.tb_n_geografic_unit.fk_power');
        $this->db->join('public.tb_n_secretary', 'public.tb_n_geografic_unit.id_geografic_unit=public.tb_n_secretary.fk_geografic_unit');
        $this->db->join('public.tb_n_subsecretary', 'public.tb_n_secretary.id_secretary=public.tb_n_subsecretary.fk_secretary');
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_part')->result();
    }

    function loadAjaxAmbitByIdPartAsociateIdSubSecretary($id_part, $id_subsecreatry){
        $this->db->select('public.tb_n_ambit.id_ambit,
                           public.tb_n_ambit.description');
        $this->db->join('public.tb_n_power', 'public.tb_n_ambit.id_ambit=public.tb_n_power.fk_ambit');
        $this->db->join('public.tb_n_geografic_unit', 'public.tb_n_power.id_power=public.tb_n_geografic_unit.fk_power');
        $this->db->join('public.tb_n_secretary', 'public.tb_n_geografic_unit.id_geografic_unit=public.tb_n_secretary.fk_geografic_unit');
        $this->db->join('public.tb_n_subsecretary', 'public.tb_n_secretary.id_secretary=public.tb_n_subsecretary.fk_secretary');

        $this->db->where('public.tb_n_ambit.fk_part',$id_part);
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_ambit')->result();
    }

    function loadAjaxPowerByIdAmbitAsociateIdSubSecretary($id_ambit, $id_subsecreatry){
        $this->db->select('public.tb_n_power.id_power,
                           public.tb_n_power.description');
        $this->db->join('public.tb_n_geografic_unit', 'public.tb_n_power.id_power=public.tb_n_geografic_unit.fk_power');
        $this->db->join('public.tb_n_secretary', 'public.tb_n_geografic_unit.id_geografic_unit=public.tb_n_secretary.fk_geografic_unit');
        $this->db->join('public.tb_n_subsecretary', 'public.tb_n_secretary.id_secretary=public.tb_n_subsecretary.fk_secretary');

        $this->db->where('public.tb_n_power.fk_ambit',$id_ambit);
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_power')->result();
    }

    function loadAjaxGeograficUnitBYIdPowerAsociateIdSubSecretary($id_power, $id_subsecreatry){
        $this->db->select('public.tb_n_geografic_unit.id_geografic_unit,
                           public.tb_n_geografic_unit.description');
        $this->db->join('public.tb_n_secretary', 'public.tb_n_geografic_unit.id_geografic_unit=public.tb_n_secretary.fk_geografic_unit');
        $this->db->join('public.tb_n_subsecretary', 'public.tb_n_secretary.id_secretary=public.tb_n_subsecretary.fk_secretary');

        $this->db->where('public.tb_n_geografic_unit.fk_power',$id_power);
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_geografic_unit')->result();
    }

    function loadAjaxSecretaryByIdGUAsociateIdSubSecretary($id_geografic_unit, $id_subsecreatry){
        $this->db->select('public.tb_n_secretary.id_secretary,
                           public.tb_n_secretary.description');
        $this->db->join('public.tb_n_subsecretary', 'public.tb_n_secretary.id_secretary=public.tb_n_subsecretary.fk_secretary');

        $this->db->where('public.tb_n_secretary.fk_geografic_unit',$id_geografic_unit);
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_secretary')->result();
    }

    function loadAjaxSubSecretaryByIdSecretaryAsociateIdSubSecretary($id_secretary, $id_subsecreatry){
        $this->db->select('public.tb_n_subsecretary.id_subsecretary,
                           public.tb_n_subsecretary.description');

        $this->db->where('public.tb_n_subsecretary.fk_secretary',$id_secretary);
        $this->db->where('public.tb_n_subsecretary.id_subsecretary',$id_subsecreatry);
        return $this->db->get('public.tb_n_subsecretary')->result();
    }
}
?>
