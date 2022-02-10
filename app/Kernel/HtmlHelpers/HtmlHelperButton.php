<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperButton extends HtmlHelperBase implements HtmlHelperInterface {
	public function content($content): static {
		$this->options->content = $content;
		return $this;
	}

	public function type(string $type): static {
		$this->addAttr('type', $type);
		return $this;
	}

	public function name(string $name): static {
		$this->addAttr('name', $name);
		return $this;
	}

	#[Pure] public function getHtml(): string {
		$attrs = $this->getAttrsString();
		$html = "<button $attrs>";
		$html .= $this->options->content;
		$html .= "</button>";
		return  $html;
	}
}