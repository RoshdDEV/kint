<?php

class Kint_Renderer_Rich_TraceFrame extends Kint_Renderer_Rich_Plugin
{
    public function render($o)
    {
        $children = $this->renderer->renderChildren($o);

        if (!($o instanceof Kint_Object_Trace_Frame)) {
            $header = Kint_Renderer_Rich::renderHeader($o);
        } else {
            if (!empty($o->trace['file']) && !empty($o->trace['line'])) {
                $header = '<var>'.Kint_Object_Blob::escape(Kint::shortenPath($o->trace['file'])).':'.(int) $o->trace['line'].'</var> ';
            } else {
                $header = '<var>PHP internal call</var> ';
            }

            if ($o->trace['class']) {
                $header .= Kint_Object_Blob::escape($o->trace['class'].$o->trace['type']);
            }

            $header .= '<dfn>'.Kint_Object_Blob::escape($o->trace['function']->getName().'('.$o->trace['function']->getParams().')').'</dfn>';
        }

        $header = Kint_Renderer_Rich::renderHeaderWrapper($o, (bool) strlen($children), $header);

        return '<dl>'.$header.$children.'</dl>';
    }
}
