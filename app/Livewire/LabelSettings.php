<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabelPrintSettings;

class LabelSettings extends Component
{
    public $label;      //settingsi total i letres prej databazes
    public $paperWidth; //gjeresia e letres
    public $paperHeight; //lartesia letres
    public $contentMargin;//margina e inner labelit
    public $headerTextSize;//madhsia tekstit te headerit
    public $headerHeight; //madhsia e headerit
    public $bodyTextSize; //madhsia tekstit ne body
    public $bodyTextAreaWidth; //gjersia e bodyt
    public $bodyTextAreaHeight; //lartesia e bodyt
    public $bodyTextMargin; //margina e teksit ne body (margjina e klientit me oren)
    public $qrcodeSize;
    public $save;
    public $name;
    public $action;
  
    public function mount($label, $action){

        $this->label = $label;
        $this->action = $action;
        $this->paperWidth = $label->paper_width;
        $this->paperHeight = $label->paper_height;
        $this->contentMargin = $label->content_margin;
        $this->headerTextSize = $label->header_text_size;
        $this->headerHeight = $label->header_height;
        $this->bodyTextSize = $label->body_text_size;
        $this->bodyTextAreaWidth = $label->body_text_area_width;
        $this->bodyTextAreaHeight = $label->body_text_area_height;
        $this->bodyTextMargin = $label->body_text_margin;
        $this->qrcodeSize = $label->qrcode_size;
        $this->name = $label->name;

        
    }

    public function submit(){

        if($this->action == 'save'){
            $this->save();
        }
        if($this->action == 'edit'){
            $this->edit();
        }
    }

    public function edit()
    {
        $this->validate([
            'paperWidth' => 'required|numeric',
            'paperHeight' => 'required|numeric',
            'contentMargin' => 'required|numeric',
            'headerTextSize' => 'required|numeric',
            'headerHeight' => 'required|numeric',
            'bodyTextSize' => 'required|numeric',
            'bodyTextAreaWidth' => 'required|numeric',
            'bodyTextAreaHeight' => 'required|numeric',
            'bodyTextMargin' => 'required|numeric',
            'qrcodeSize' => 'required|numeric',
        ]);

        LabelPrintSettings::where('chosen', 1)->update(['chosen' => 0]);
        LabelPrintSettings::findOrFail($this->label->id)->update([
            'paper_width' => $this->paperWidth,
            'paper_height' => $this->paperHeight,
            'content_margin' => $this->contentMargin,
            'header_text_size' => $this->headerTextSize,
            'header_height' => $this->headerHeight,
            'body_text_size' => $this->bodyTextSize,
            'body_text_area_width' => $this->bodyTextAreaWidth,
            'body_text_area_height' => $this->bodyTextAreaHeight,
            'body_text_margin' => $this->bodyTextMargin,
            'qrcode_size' => $this->qrcodeSize,
            'chosen' => 1,
        ]);
        
        session()->flash('success', 'Label settings updated successfully.');
    }

    public function save()
    {
        $this->validate([
            'paperWidth' => 'required|numeric',
            'paperHeight' => 'required|numeric',
            'contentMargin' => 'required|numeric',
            'headerTextSize' => 'required|numeric',
            'headerHeight' => 'required|numeric',
            'bodyTextSize' => 'required|numeric',
            'bodyTextAreaWidth' => 'required|numeric',
            'bodyTextAreaHeight' => 'required|numeric',
            'bodyTextMargin' => 'required|numeric',
            'qrcodeSize' => 'required|numeric',
        ]);
        
        LabelPrintSettings::where('chosen', 1)->update(['chosen' => 0]);
        $newRecord = new LabelPrintSettings;
        
        $newRecord = new LabelPrintSettings;
        $newRecord->paper_width = $this->paperWidth;
        $newRecord->paper_height = $this->paperHeight;
        $newRecord->content_margin = $this->contentMargin;
        $newRecord->header_text_size = $this->headerTextSize;
        $newRecord->header_height = $this->headerHeight;
        $newRecord->body_text_size = $this->bodyTextSize;
        $newRecord->body_text_area_width = $this->bodyTextAreaWidth;
        $newRecord->body_text_area_height = $this->bodyTextAreaHeight;
        $newRecord->body_text_margin = $this->bodyTextMargin;
        $newRecord->qrcode_size = $this->qrcodeSize;
        $newRecord->chosen = 1;
        $newRecord->name = $this->name;

        $newRecord->save();
        
        redirect()->route('label-settings.index')->with('success', 'Label settings updated successfully.');
    }
 
    public function render()
    {
        return view('livewire.label-settings'); 
    }
}
