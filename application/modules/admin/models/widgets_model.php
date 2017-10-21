<?php
class Widgets_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_widget_content($id){
    $this->db->where('widget_id',$id);
    $this->db->where('widget_status','Yes');
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return "<span class='widget-content'>".$content[0]->widget_content."</span>";

    }else{

      return '';
    }

    }
    
    function get_widget_freshcontent($id){
    $this->db->where('widget_id',$id);
    $this->db->where('widget_status','Yes');
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return $content[0]->widget_content;

    }else{

      return '';
    }

    }
    
    function get_widget_title($id){
    $this->db->where('widget_id',$id);
    $this->db->where('widget_status','Yes');
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return $content[0]->widget_title;

    }else{

      return '';
    }

    }
    
    function get_widget_name($id){
    $this->db->where('widget_id',$id);
    $this->db->where('widget_status','Yes');
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return $content[0]->widget_name;

    }else{

      return '';
    }

    }
    
    function get_widget_id($location_id,$locate=null){
    $this->db->like('widget_title',$location_id);
    if($locate!=null) {
        $this->db->like('widget_location',$locate);
    }
    $content = $this->db->get('pt_widgets')->result();
    if(!empty($content)){

    return $content[0]->widget_id;

    } else {

      return '';
    }

    }
    
    function get_widget_ids($location_id,$locate=null){
    $this->db->select('widget_id');
    $this->db->like('widget_title',$location_id);
    if($locate!=null) {
        $this->db->like('widget_location',$locate);
    }
    return $this->db->get('pt_widgets')->result();


    }

    function getWidgetDetails($id){

    $this->db->where('widget_id',$id);
    return $this->db->get('pt_widgets')->result();
    

    }

    function addWidget(){
        $widlocation = $this->input->post('widlocation');
        $position = $this->input->post('position');
        if($widlocation !="") $widget_location = $widlocation;
        elseif($position!="") $widget_location = $position;
        else $widget_location = null;
              $data = array(
            'widget_name' => $this->input->post('title'),
            'widget_status' => $this->input->post('status'),
            'widget_title' => $this->input->post('widtitle'),
            'widget_location' => $widget_location,
            'widget_content' => $this->input->post('widgetbody')
            );
        $this->db->insert('pt_widgets',$data);
    }

    function updateWidget($id){
        $widlocation = $this->input->post('widlocation');
        $position = $this->input->post('position');
        if($widlocation !="") $widget_location = $widlocation;
        elseif($position!="") $widget_location = $position;
        else $widget_location = null;
        $data = array(
            'widget_name' => $this->input->post('title'),
            'widget_status' => $this->input->post('status'),
            'widget_title' => $this->input->post('widtitle'),
            'widget_location' => $widget_location,
            'widget_content' => $this->input->post('widgetbody')
            );
        $this->db->where('widget_id',$id);
        $this->db->update('pt_widgets',$data);

    }

    function deleteWidget($id){
        $this->db->where('widget_id',$id);
        $this->db->delete('pt_widgets');
        
    }


 }