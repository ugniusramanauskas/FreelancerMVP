<?php

namespace TGC\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TGCAdminBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
